(:
  ============================================================
  XQuery Examples
  ============================================================
  XQuery is the query language for XML data.
  It is used to query and transform XML documents.
  
  Run these examples in an XQuery processor like:
  - BaseX (basex.org)
  - Zorba (zorba-xquery.com)
  - Saxon (saxonica.com)
  - eXist-db (exist-db.org)
  ============================================================
:)

(: ============================================================
   Example 1: Basic doc() function - Loading XML
   ============================================================ :)

(: Load an XML document from a file or URL :)
(: doc("books.xml") :)

(: Inline XML for demonstration :)
let $books :=
  <library>
    <book id="B001" category="fiction">
      <title lang="en">The Great Gatsby</title>
      <author>F. Scott Fitzgerald</author>
      <year>1925</year>
      <price currency="USD">12.99</price>
    </book>
    <book id="B002" category="fiction">
      <title lang="en">1984</title>
      <author>George Orwell</author>
      <year>1949</year>
      <price currency="USD">10.99</price>
    </book>
    <book id="B003" category="reference">
      <title lang="en">Introduction to Algorithms</title>
      <author>Thomas H. Cormen</author>
      <year>2009</year>
      <price currency="USD">75.00</price>
    </book>
    <book id="B004" category="fiction">
      <title lang="es">Cien Anos de Soledad</title>
      <author>Gabriel Garcia Marquez</author>
      <year>1967</year>
      <price currency="USD">14.50</price>
    </book>
    <book id="B005" category="reference">
      <title lang="en">Design Patterns</title>
      <author>Erich Gamma</author>
      <year>1994</year>
      <price currency="USD">45.99</price>
    </book>
  </library>

(: ============================================================
   Example 2: Path Expressions - Selecting XML nodes
   ============================================================ :)

(: Select all book titles :)
return
<results>
  <section name="All Titles">
    {$books//book/title}
  </section>

  (: Select all authors :)
  <section name="All Authors">
    {$books//book/author}
  </section>

  (: Select specific book by attribute :)
  <section name="Book B003">
    {$books//book[@id='B003']}
  </section>

  (: Select books published before 1960 :)
  <section name="Books Before 1960">
    {$books//book[year < 1960]/title}
  </section>

  (: ============================================================
     Example 3: Predicates - Filtering nodes
     ============================================================ :)

  (: Fiction books only :)
  <section name="Fiction Books">
    {$books//book[@category='fiction']}
  </section>

  (: Books with price less than 20 :)
  <section name="Cheap Books (under $20)">
    {$books//book[price < 20]/title}
  </section>

  (: Books in English :)
  <section name="English Books">
    {$books//book[title/@lang='en']/title}
  </section>

  (: First book only (using position) :)
  <section name="First Book">
    {$books//book[1]}
  </section>

  (: Books by specific author :)
  <section name="Books by Orwell">
    {$books//book[author='George Orwell']}
  </section>

  (: ============================================================
     Example 4: FLWOR Expressions
     ============================================================ :)
  (: FLWOR = For, Let, Where, Order by, Return :)

  (: For loop - iterate over all books :)
  <section name="FLWOR - All Books">
    {
      for $book in $books//book
      return
        <item>
          <title>{string($book/title)}</title>
          <author>{string($book/author)}</author>
          <year>{number($book/year)}</year>
        </item>
    }
  </section>

  (: Where clause - filter books :)
  <section name="FLWOR - Fiction Books After 1950">
    {
      for $book in $books//book
      where $book/@category = 'fiction'
      where $book/year > 1950
      order by $book/year ascending
      return
        <item>
          <title>{string($book/title)}</title>
          <year>{number($book/year)}</year>
          <price>{string($book/price)}</price>
        </item>
    }
  </section>

  (: Let clause - assign variables :)
  <section name="FLWOR - Price Calculations">
    {
      let $fictionBooks := $books//book[@category='fiction']
      let $totalPrice := sum($fictionBooks/price)
      let $avgPrice := avg($fictionBooks/price)
      let $minPrice := min($fictionBooks/price)
      let $maxPrice := max($fictionBooks/price)
      return
        <summary>
          <total-fiction-books>{count($fictionBooks)}</total-fiction-books>
          <total-price>{string($totalPrice)}</total-price>
          <average-price>{string(round($avgPrice * 100) div 100)}</average-price>
          <min-price>{string($minPrice)}</min-price>
          <max-price>{string($maxPrice)}</max-price>
        </summary>
    }
  </section>

  (: Aggregation :)
  <section name="FLWOR - Aggregation">
    {
      for $category in distinct-values($books//book/@category)
      let $catBooks := $books//book[@category = $category]
      return
        <category name="{$category}">
          <count>{count($catBooks)}</count>
          <avg-price>{string(round(avg($catBooks/price) * 100) div 100)}</avg-price>
        </category>
    }
  </section>

  (: ============================================================
     Example 5: Constructing XML Output
     ============================================================ :)

  <section name="Constructed XML Report">
    <report generated="{current-date()}">
      <booklist>
        {
          for $book in $books//book
          order by $book/year ascending
          return
            <entry id="{$book/@id}">
              <title>{string($book/title)}</title>
              <author>{string($book/author)}</author>
              <year>{string($book/year)}</year>
              <age>{year-from-date(current-date()) - number($book/year)}</age>
              <price>{concat($book/price, ' ', string($book/price/@currency))}</price>
            </entry>
        }
      </booklist>
      <summary>
        <total-books>{count($books//book)}</total-books>
        <total-value>{concat(sum($books//book/price), ' USD')}</total-value>
      </summary>
    </report>
  </section>

</results>

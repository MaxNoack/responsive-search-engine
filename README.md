# responsive-search-engine
A responsive search engine for product searching

<h3>Smart search features</h3>

- A search for <i>playstation sony</i> matches all products containing <i>playstation</i> OR <i>sony</i> in it's name or category name. For example we will get a match on a product named "Sony Playstation 3"
- Search results is ordered by relevance were most occurrences is ranked the highest
- Supports one or more exact matches within double quotes (<i>"</i>). Eg. samsung <i>"galaxy s"</i> will match <i>Samsung GT-i9100 Galaxy S II</i>, but not <i>Samsung GT-N7100 Galaxy Note II 16GB</i>
- Supports one or more negative searches with minus (<i>-</i>). Eg. <i>iphone -5</i> will match all iPhones, except iPhone 5's
- Searches will only match IDs if the match is exactly the same

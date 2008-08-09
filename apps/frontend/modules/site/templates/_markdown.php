<h1>Markdown Syntax</h1>
<p>You can post your snippets and comments using Markdown's
formatting syntax. Markdown is a lightweight markup language, which aims
for maximum readability and "publishability" of both its input and
output forms, taking many cues from existing conventions for marking up
plain text in email. Following is a cheatsheet that will help you type
your own Markdown-formatted text quickly. See the <a
	href="http://daringfireball.net/projects/markdown/syntax"
	target="_blank">full Markdown syntax</a> for more information.</p>

<h2>Cheatsheet</h2>

<h3>Phrase Emphasis</h3>

<pre><code>*italic*   **bold**
_italic_   __bold__
</code></pre>

<h3>Links</h3>

<p>Inline:</p>

<pre><code>An [example](http://url.com/ "Title")
</code></pre>

<p>Reference-style labels (titles are optional):</p>

<pre><code>An [example][id]. Then, anywhere
else in the doc, define the link:

  [id]: http://example.com/  "Title"
</code></pre>

<h3>Images</h3>

<p>Inline (titles are optional):</p>

<pre><code>![alt text](/path/img.jpg "Title")
</code></pre>

<p>Reference-style:</p>

<pre><code>![alt text][id]

[id]: /url/to/img.jpg "Title"
</code></pre>

<h3>Headers</h3>

<p>Setext-style:</p>

<pre><code>Header 1
========

Header 2
--------
</code></pre>

<p>atx-style (closing #'s are optional):</p>

<pre><code># Header 1 #

## Header 2 ##

###### Header 6
</code></pre>

<h3>Lists</h3>

<p>Ordered, without paragraphs:</p>

<pre><code>1.  Foo
2.  Bar

</code></pre>

<p>Unordered, with paragraphs:</p>

<pre><code>*   A list item.

    With multiple paragraphs.

*   Bar
</code></pre>

<p>You can nest them:</p>

<pre><code>*   Abacus
    * answer
*   Bubbles
    1.  bunk
    2.  bupkis
        * BELITTLER
    3. burper
*   Cunning
</code></pre>

<h3>Blockquotes</h3>

<pre><code>&gt; Email-style angle brackets
&gt; are used for blockquotes.

&gt; &gt; And, they can be nested.

&gt; #### Headers in blockquotes
&gt; 
&gt; * You can quote a list.
&gt; * Etc.
</code></pre>

<h3>Code Spans</h3>

<pre><code>`&lt;code&gt;` spans are delimited
by backticks.

You can include literal backticks
like `` `this` ``.
</code></pre>

<h3>Preformatted Code Blocks</h3>

<p>Indent every line of a code block by at least 4 spaces or 1 tab.</p>

<pre><code>This is a normal paragraph.

    This is a preformatted
    code block.
</code></pre>

<p>You can also specify the programming language in square brackets
so that it can be recognized and possibly highlighted by our syntax
highlighting engine.</p>

<pre><code>    [java]
    public class HelloWorld {
        public static void main() {
            System.out.println("Hello World!");
        }
    }
</code></pre>

<p>Following is the list of all valid programming languages. The
ones written in bold are also supported by our syntax highlighting
engine. We strongly suggest you to specify the programming language even
though it is not supported by the engine. Since, it may be supported in
the near future.</p>

<ul>
	<li>[c] - C</li>
	<li><strong>[cpp]</strong> - C++</li>
	<li>[html] - HTML</li>
	<li><strong>[java]</strong> - Java</li>
	<li><strong>[php]</strong> - PHP</li>
	<li>[ruby] - Ruby</li>
	<li>[sql] - SQL</li>
	<li>[xml] - XML</li>
</ul>

<h3>Horizontal Rules</h3>

<p>Three or more dashes or asterisks:</p>

<pre><code>---

* * *

- - - - 
</code></pre>

<h3>Manual Line Breaks</h3>

<p>End a line with two or more spaces:</p>

<pre><code>Roses are red,   
Violets are blue.
</code></pre>
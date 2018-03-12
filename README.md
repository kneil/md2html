Installation
------------

Run:

<pre>composer install</pre>


How to use
----------

<pre>php bin/md2html [--in input file] [--out output file]</pre>

To display the usage run:

<pre>php bin/md2html  --help</pre>

If --in is omitted then STDIN is used for input.
If --out is omitted then STDOUT Is used for output.

Without any switches the script assumes that STDIN and STDOUT are
to be used for input and output respectively.

How to run tests
----------------

Run

<pre>vendor/bin/phpunit tests</pre>

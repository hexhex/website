# $1: Instance (wine category)
# $2: Output filename

echo "
wine(X) :- &dlC[\"wine.rdf\", empty, empty, empty, empty, \"http://www.w3.org/TR/2003/PR-owl-guide-20031209/wine#$1\"](X).

% By default, a wine is white:
whitewine(\"WhiteWine\", X) :- wine(X), not redwine(X).

% Single out the red wines under default assumption:
redwine(X) :- wine(X), &dlC[\"wine.rdf\", whitewine, empty, empty, empty, \"http://www.w3.org/TR/2003/PR-owl-guide-20031209/wine#RedWine\"](X)<fullylinear>.

inconsistent :- not &dlConsistent[\"wine.rdf\", whitewine, empty, empty, empty]().
:- inconsistent.
" > $2
# $1: Instance (wine category)
# $2: Output filename

echo "
wine(X) :- &dlC[\"wine.rdf\", empty, empty, empty, empty, \"http://www.w3.org/TR/2003/PR-owl-guide-20031209/wine#$1\"](X).

% By default, a wine is dry:
drywine(\"DryWine\", X) :- wine(X), not sweetwine(X).

% Single out the red wines under default assumption:
sweetwine(X) :- wine(X), &dlC[\"wine.rdf\", drywine, empty, empty, empty, \"http://www.w3.org/TR/2003/PR-owl-guide-20031209/wine#SweetWine\"](X)<fullylinear>.

inconsistent :- not &dlConsistent[\"wine.rdf\", drywine, empty, empty, empty]().
:- inconsistent.
" > $2
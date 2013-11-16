# build all files
rm wml/*.html
rm wml/template/*.html
rm wml/template/actionplugin/*.html
for f in wml/*.wml
do
	echo $f
	fn=$(echo $f | cut -d'.' --complement -f2-)
	wml -I wml/template $f > $fn.html
done
for f in wml/actionplugin/*.wml
do
	echo $f
	fn=$(echo $f | cut -d'.' --complement -f2-)
	wml -I wml/template -I wml/actionplugin $f > $fn.html
done

# copy to root
cp wml/*.html ./
cp wml/actionplugin/*.html ./actionplugin/

# provide stylesheets and images for to subdirectories
cp images/*.png ./actionplugin/images/
cp css/*.css ./actionplugin/css/

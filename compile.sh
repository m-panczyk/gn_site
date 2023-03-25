#!/bin/sh
#script to join html files 
#base.html + index.base.html = index.html and so on
#index.base.html should be inserted into <main> tag of base.html
#its usnig awk to insert index.base.html into base.html

ls *.base.html | while read file
do
    clearFile=`echo $file | sed 's/.base.html//'`
    awk '/<main>/ { system("cat '$file'") } { print }' base.html > $clearFile.html
done

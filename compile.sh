#!/bin/sh
#script to join html files 
#base.html + index.base.html = index.html and so on
#index.base.html should be inserted into <main> tag of base.html
#its usnig awk to insert index.base.html into base.html

ls *.base.html | while read file
do
    clearFile=`echo $file | sed 's/.base.html//'`
    echo > $clearFile.html
    while read line
    do
        if [[ $line == *"</head>"* ]]; then
            echo "head found"
            #print first line of $file
            head -n1 $file >> $clearFile.html
            head -n1 $file
            echo $line >> $clearFile.html
        elif grep -q "</main>" <<< "$line"; then
            echo "main found"
            tail -n+2 $file >> $clearFile.html
            echo $line >> $clearFile.html
        else
            echo $line >> $clearFile.html
        fi
    done < base.html
done


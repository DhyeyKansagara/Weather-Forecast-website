#!/bin/bash

while true
do
    #variables for all the city web pages
    newark="https://forecast.weather.gov/MapClick.php?CityName=Newark&state=NJ"
    hoboken="https://forecast.weather.gov/MapClick.php?CityName=Hoboken&state=NJ"
    clifton="https://forecast.weather.gov/MapClick.php?CityName=Clifton&state=NJ"
    kearny="https://forecast.weather.gov/MapClick.php?CityName=Kearny&state=NJ"
    trenton="https://forecast.weather.gov/MapClick.php?CityName=Trenton&state=NJ"

    counter=0
    cityNames=(Newark Hoboken Clifton Kearny Trenton)
    for city in $newark $hoboken $clifton $kearny $trenton
    do
        
        wget -O ${cityNames[$counter]} $city 
        (( counter++ ))
    done 

    if [[ ! -f tagsoup-1.2.1.jar ]]
    then
        wget https://repo1.maven.org/maven2/org/ccil/cowan/tagsoup/tagsoup/1.2.1/tagsoup-1.2.1.jar
    fi 

    for cN in ${cityNames[@]}
    do
        java -jar tagsoup-1.2.1.jar --files $cN
    done

    for name in ${cityNames[@]}
    do
        python3 parser.py $name.xhtml
    done

    sleep 4
    
    rm -f Clifton
    rm -f Hoboken
    rm -f Newark
    rm -f Trenton
    rm -f Kearny

    rm -f *.xhtml

    sleep 6h
done
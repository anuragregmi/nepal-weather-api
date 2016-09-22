# nepal-weather-api
weather api for nepal 
currently hosted at heroku as https://nepal-weather-api.herokuapp.com/

#USING THE API
  This api uses get request and returns value in json format.
  <br>
  pass `` ?place=placename ``for weather in English
  <br>
  pass `` ?placenp=placename`` for weather in Nepali
  
  eg. ``https://nepal-weather-api.herokuapp.com/api/?place=all`` will return something like
```
{"status":"true","1":{"status":"true","place":"Dadeldhura","max":"24.8 C","min":"16.0 C","rain":"0.0 mm"},"2":{"status":"true","place":"Dipayal","max":"33.5 C","min":"23.0 C","rain":"5.2 mm"},"3":{"status":"true","place":"Dhangadi","max":"32.2 C","min":"24.9 C","rain":"Traces"},"4":{"status":"true","place":"Birendranagar","max":"31.9 C","min":"21.9 C","rain":"Traces"},"5":{"status":"true","place":"Nepalgunj","max":"34.0 C","min":"25.0 C","rain":"0.0 mm"},"6":{"status":"true","place":"Jumla","max":"27.3 C","min":"13.6 C","rain":"0.0 mm"},"7":{"status":"true","place":"Dang","max":"31.8 C","min":"21.5 C","rain":"0.4 mm"},"8":{"status":"true","place":"Pokhara","max":"30.2 C","min":"20.5 C","rain":"274.2 mm"},"9":{"status":"true","place":"Bhairahawa","max":"34.0 C","min":"24.4 C","rain":"41.1 mm"},"10":{"status":"true","place":"Simara","max":"33.5 C","min":"25.0 C","rain":"0.0 mm"},"11":{"status":"true","place":"Kathmandu","max":"27.8 C","min":"18.4 C","rain":"16.6 mm"},"12":{"status":"true","place":"Okhaldhunga","max":"23.4 C","min":"16.8 C","rain":"33.2 mm"},"13":{"status":"true","place":"Taplejung","max":"26.2 C","min":"17.2 C","rain":"4.0 mm"},"14":{"status":"true","place":"Dhankuta","max":"28.4 C","min":"20.0 C","rain":"0.8 mm"},"15":{"status":"true","place":"Biratnagar","max":"33.2 C","min":"23.7 C","rain":"12.7 mm"},"16":{"status":"true","place":"Jomsom","max":"21.0 C","min":"12.0 C","rain":"0.0* mm"},"17":{"status":"true","place":"Dharan","max":"32.5 C","min":"24.6 C","rain":"2.1* mm"},"18":{"status":"true","place":"Lumle","max":"23.5 C","min":"15.5 C","rain":"84.8* mm"},"19":{"status":"true","place":"Jankapur","max":"34.2 C","min":"26.2 C","rain":"0.0* mm"},"20":{"status":"true","place":"Jiri","max":"23.0 C","min":"17.0 C","rain":"14.7* mm"}}
```

and ``https://nepal-weather-api.herokuapp.com/api/?placenp=all`` will return something like
```
{"1":{"status":"true","place":"डढेलधुरा","max":"२४.८ C","min":"१६.० C","rain":"०.० mm"},"2":{"status":"true","place":"दिपाएल","max":"३३.५ C","min":"२३.० C","rain":"५.२ mm"},"3":{"status":"true","place":"धनगढी","max":"३२.२ C","min":"२४.९ C","rain":"फाटफुट"},"4":{"status":"true","place":"बिरेन्द्र्नगर","max":"३१.९ C","min":"२१.९ C","rain":"फाटफुट"},"5":{"status":"true","place":"नेपालगञ्ज","max":"३४.० C","min":"२५.० C","rain":"०.० mm"},"6":{"status":"true","place":"जुम्ला","max":"२७.३ C","min":"१३.६ C","rain":"०.० mm"},"7":{"status":"true","place":"दाङ","max":"३१.८ C","min":"२१.५ C","rain":"०.४ mm"},"8":{"status":"true","place":"पोखरा","max":"३०.२ C","min":"२०.५ C","rain":"२७४.२ mm"},"9":{"status":"true","place":"भैरहवा","max":"३४.० C","min":"२४.४ C","rain":"४१.१ mm"},"10":{"status":"true","place":"सिमारा","max":"३३.५ C","min":"२५.० C","rain":"०.० mm"},"11":{"status":"true","place":"काठमाडौं","max":"२७.८ C","min":"१८.४ C","rain":"१६.६ mm"},"12":{"status":"true","place":"ओखल्ढुङ्गा","max":"२३.४ C","min":"१६.८ C","rain":"३३.२ mm"},"13":{"status":"true","place":"ताप्लेजुङ","max":"२६.२ C","min":"१७.२ C","rain":"४.० mm"},"14":{"status":"true","place":"धनकुटा","max":"२८.४ C","min":"२०.० C","rain":"०.८ mm"},"15":{"status":"true","place":"बिराटनगर","max":"३३.२ C","min":"२३.७ C","rain":"१२.७ mm"},"16":{"status":"true","place":"जोम्सोम","max":"२१.० C","min":"१२.० C","rain":"०.०* mm"},"17":{"status":"true","place":"धरान","max":"३२.५ C","min":"२४.६ C","rain":"२.१* mm"},"18":{"status":"true","place":"लुम्ले","max":"२३.५ C","min":"१५.५ C","rain":"८४.८* mm"},"19":{"status":"true","place":"जनकपुर","max":"३४.२ C","min":"२६.२ C","rain":"०.०* mm"},"20":{"status":"true","place":"जिरी","max":"२३.० C","min":"१७.० C","rain":"१४.७* mm"}}
```

###for particular place
``https://nepal-weather-api.herokuapp.com/api/?place=dang`` will return something like
```
{"status":"true","place":"Dang","max":"31.8 C","min":"21.5 C","rain":"0.4 mm"}
```
and ``https://nepal-weather-api.herokuapp.com/api/?placenp=dang`` will return something like
```
{"status":"true","place":"दाङ","max":"३१.८ C","min":"२१.५ C","rain":"०.४ mm"}
```

### if failed
if place not found then it will return
```
{"status":"false","msg":"sorry could not find that place... please pass the place=[one of the valid places]","valid_places":['Dadeldhura','Dipayal','Dhangadi','Birendranagar','Nepalgunj','Jumla','Dang','Pokhara','Bhairahawa','Simara','Kathmandu','Okhaldhunga','Taplejung','Dhankuta','Biratnagar','Jomsom','Dharan','Lumle','Janakpur','Jiri']}
```
if nothing passed then it will return nothing
	
	

#AVAILABLE placename
These are simply places available at http://mfd.gov.np/weather/ science all the data are scrapped from that site<br>
```Dadeldhura,Dipayal,Dhangadi , Birendranagar , Nepalgunj , Jumla , Dang , Pokhara , Bhairahawa , Simara , Kathmandu , Okhaldhunga , Taplejung , Dhankuta , Biratnagar , Jomsom , Dharan , Lumle , Janakpur , Jiri``` 

	


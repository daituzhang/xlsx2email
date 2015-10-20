# xlsx2email
* Auto generate inline css html and text version for your template
* Auto read through a xlsx file and generate html emails based on template you create

## Using librarys
* [Gulp](https://github.com/gulpjs/gulp)
* [Gulp](https://github.com/appleboy/gulp-compass)
* [Ink](https://github.com/zurb/ink) ---> responsive css frame work
* [Premailer](https://github.com/premailer/premailer) ---> inline css generating
* [simpleXLSX](http://www.phpclasses.org/package/6279-PHP-Parse-and-retrieve-data-from-Excel-XLS-files.html) --> xlsx reading

## Install
Preinstall [Premailer](https://github.com/premailer/premailer)
`npm install`

## Setting
open gulpfile and you can modify:
```
var file = 'template/normal/template.html';
var xlsx_file = "xlsx/xlsx.xlsx";
var email_dir = "html/";
var key_code = "file-name";
```

## Running 
with Guard and Premailer: Run guard

Other wise:
```Gulp
```

## Template lauguage
* Put '{{' and '}}' next to your key words
* Key words must match to index row in your spread sheet
* Ex: 
```html
<h1> {{title}} </h1>
<p> {{body}} </p>
```

##xlsx File
* It has to be .xlsx
* Row index must match key words in template
* There need to be one index for unique key code to generate the emails name
* Do not put white space in key code if you are using guard
* Ex:

| keycode | title | body |
| ------- | ----- | ---- |
| 1 | hello | world |
| 2 | hi | how are you |



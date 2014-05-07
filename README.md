# xlsx2email
* Auto generate inline css html and text version for your template
* Auto read through a xlsx file and generate html emails based on template you create

## Using librarys
* [Guard](https://github.com/guard/guard) --> Listening template changing
* [Ink](https://github.com/zurb/ink) ---> responsive css frame work
* [Premailer](https://github.com/premailer/premailer) ---> inline css generating
* [simpleXLSX](http://www.phpclasses.org/package/6279-PHP-Parse-and-retrieve-data-from-Excel-XLS-files.html) --> xlsx reading

## Install
Install [Premailer](https://github.com/premailer/premailer) and [Guard](https://github.com/guard/guard)

You can still use xlsx2email without premailer and guard
```bash
php xlsx2email.php template_file xlsx_file email_dir key_code
```

## Setting
Guardfile
```ruby
#template file path
template_file= "template/template.html";

#xlsx file path
xlsx_file = "xlsx/xlsx.xlsx";

#dir for emails path
email_dir = "html/";

#option: key code for email names
key_code = "keycode"
```

## Running 
Run guard

## Template lauguage
* Put '{{' and '}}' next to your key words
* Ex: 
```html
<h1> {{title}} </h1>
<p> {{body}} </p>
```
* Key words must match to index row in your spread sheet

##xlsx File
* It has to be .xlsx
* Row index must match key words in template
* There need to be one index for unique key code to generate the emails name
* Do not put white space in key code if you are using guard
Ex:
Delete this content

| keycode | title | body |
| ------- | ----- | ---- |
| 1 | hello | world |
| 2 | hi | how are you |



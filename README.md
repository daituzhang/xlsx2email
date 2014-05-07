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

You can still use xlsx2email without premailer and guard (no auto listen to your template)

## Setting(only with guard)
```bash
guard init
```
open Guardfile and place the following in. 

You can modify the user setting area as the path you need
```ruby
require 'pathname'
####################################################
################# user setting here ################
####################################################

print "thank you for using xlsx2email"

#template file path
template_file= "template/template.html";

#xlsx file path
xlsx_file = "xlsx/xlsx.xlsx";

#dir for emails path
email_dir = "html/";

#option: key code for email names
key_code = "keycode"

####################################################
################ user setting ends #################
####################################################

# create the html folders
if (File.directory? email_dir + 'normal') == false
	Dir.mkdir email_dir + 'normal'
end
if (File.directory? email_dir + 'inline') == false
	Dir.mkdir email_dir + 'inline'
end
if (File.directory? email_dir + 'text') == false
	Dir.mkdir email_dir + 'text'
end

guard :shell do
  watch(/(.*).txt/) {|m| `tail #{m[0]}` }
end

watch(%r{^template/.+\.(css|js)}) { `ruby inlinecss.rb #{template_file}` }
watch(%r{^template/template.html}) { `ruby inlinecss.rb #{template_file}` }
watch(%r{^template/template-inline-copy.html}) { `php xlsx2email.php #{template_file} #{xlsx_file} #{email_dir} #{key_code}` }
```

## Running 
with Guard and Premailer: Run guard

Other wise:
```bash
php xlsx2email.php template_file xlsx_file email_dir key_code
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



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
# => Errno::ENOENT: No such file or directory - 'foo/bar'



# More info at https://github.com/guard/guard#readme
guard 'livereload' do
  watch(%r{app/views/.+\.(erb|haml|slim)$})
  watch(%r{app/helpers/.+\.rb})
  watch(%r{public/.+\.(css|js|html)})
  watch(%r{config/locales/.+\.yml})
  # Rails Assets Pipeline
  watch(%r{(app|vendor)(/assets/\w+/(.+\.(css|js|html|png|jpg))).*}) { |m| "/assets/#{m[3]}" }
end

# Add files and commands to this file, like the example:
#   watch(%r{file/path}) { `command(s)` }
#
guard :shell do
  watch(/(.*).txt/) {|m| `tail #{m[0]}` }
end

watch(%r{^template/.+\.(css|js)}) { `ruby inlinecss.rb #{template_file}` }
watch(%r{^template/template.html}) { `ruby inlinecss.rb #{template_file}` }
watch(%r{^template/template-inline-copy.html}) { `php xlsx2email.php #{template_file} #{xlsx_file} #{email_dir} #{key_code}` }



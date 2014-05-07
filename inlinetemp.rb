require 'rubygems' # optional for Ruby 1.9 or above.
require 'premailer'
require 'pathname'

###########################################
# generate inline template and plain text #
###########################################
if ARGV[0]
	file = ARGV[0]
	file_inline = file.gsub(/(.*)(.html)(.*)/, '\1-inline.html\3')
	file_inline_copy = file.gsub(/(.*)(.html)(.*)/, '\1-inline-copy.html\3')
	file_text = file.gsub(/(.*)(.html)(.*)/, '\1-text.txt\3')

	premailer = Premailer.new( file, :warn_level => Premailer::Warnings::SAFE)
	# Write the HTML output
	File.open(file_inline, "w") do |fout|
	  fout.puts premailer.to_inline_css
	end

	# Write the HTML output
	File.open(file_inline_copy, "w") do |fout|
	  fout.puts premailer.to_inline_css
	end

	# Write the plain-text output
	File.open(file_text,"w") do |fout|
	  fout.puts premailer.to_plain_text
	end

	# Output any CSS warnings
	premailer.warnings.each do |w|
	  puts "#{w[:message]} (#{w[:level]}) may not render properly in #{w[:clients]}"
	end

#########
# error #
#########
else 
	print "can not find template file"
end


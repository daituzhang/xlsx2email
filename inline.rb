require 'rubygems' # optional for Ruby 1.9 or above.
require 'premailer'
require 'pathname'

dir = "/Users/yuluzhang/premailer/html/"
dirpath = dir+"normal/**/*.html"


Dir[dirpath].each do |file| 
	fileparent = file.split(dir+'normal/', 2).last
	filename = File.basename(fileparent,".html")
	premailer = Premailer.new( file, :warn_level => Premailer::Warnings::SAFE)
	# Write the HTML output
	File.open(dir + "inline/" + fileparent , "w") do |fout|
	  fout.puts premailer.to_inline_css
	end

	# Write the plain-text output
	File.open(dir + "text/" + fileparent, "w") do |fout|
	  fout.puts premailer.to_plain_text
	end

	# Output any CSS warnings
	#premailer.warnings.each do |w|
	  #puts "#{w[:message]} (#{w[:level]}) may not render properly in #{w[:clients]}"
	#end
end



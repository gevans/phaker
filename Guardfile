#!/usr/bin/env ruby
#^syntax detection

guard 'bundler' do
  watch('Gemfile')
end

guard 'phpunit', :tests_path => 'test', :cli => '--bootstrap vendor/.composer/autoload.php --colors' do
  watch(%r{^.+Test\.php$})
  watch(%r{^lib/(.+)\.php$}) {|m| "test/#{m[1]}Test.php" }
end

guard 'phpcs', :standard => '../coding-standards/PHP/CodeSniffer/Standards/Kohana' do
  watch(%r{^.+\.php$})
end

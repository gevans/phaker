require 'rbconfig'
HOST_OS = RbConfig::CONFIG['host_os']

source :rubygems

group :development do
  gem 'guard'

  case HOST_OS
  when /darwin/i
    gem 'rb-fsevent'
    gem 'growl'
  when /linux/i
    gem 'libnotify'
    gem 'rb-inotify'
  when /mswin|windows/i
    gem 'rb-fchange'
    gem 'win32console'
    gem 'rb-notifu'
  end

  gem 'guard-bundler'
  gem 'guard-phpunit'
  gem 'guard-phpcs'
end
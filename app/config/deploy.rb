set :application, "ToBeDone"
set :domain,      "192.168.1.20"
set :user,        "px"
set :deploy_to,   "/var/www/html"
set :app_path,    "app"


set :repository,  "https://github.com/petryshend/tobedone.git"
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  3

# Be more verbose by uncommenting the following line
# logger.level = Logger::MAX_LEVEL

default_run_options[:pty] = true


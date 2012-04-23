set :serverName,   "nogetmedkode.dk" # The server's hostname
set :repository,   "file:///Users/troels.johnsen/Web/actualskill.dev"

set :domain,      "time.pressplay.dk"
set :deploy_to,   "/srv/www/time.pressplay.dk" # Remote location where the project will be stored
ssh_options[:port] = 22

set :scm,         :git
set :deploy_via,  :rsync_with_remote_cache
set :user,        "root"

# Roles
role :web,        domain
role :app,        domain
role :db,         domain, :primary => true

set  :keep_releases,  3 # The number of releases which will remain on the server
set  :use_sudo,       false

# Update vendors during the deploy
set :update_vendors, true

# Set some paths to be shared between versions
set :shared_files,    ["app/config/parameters.ini"]
set :shared_children, [app_path + "/logs", web_path + "/uploads", "vendor"]
require 'mina/rails'
require 'mina/git'

# Basic settings:
#   domain       - The hostname to SSH to.
#   deploy_to    - Path to deploy into.
#   repository   - Git repo to clone from. (needed by mina/git)
#   branch       - Branch name to deploy. (needed by mina/git)

set :domain, 'c-und-c.one'
set :deploy_to, '/var/www/c-und-c.one'
set :repository, 'https://github.com/hollodotme/ccone.git'
set :branch, 'master'
set :keep_releases, 3

# Manually create these paths in shared/ (eg: shared/config/database.yml) in your server.
# They will be linked in the 'deploy:link_shared_paths' step.
#set :shared_paths, ['config/database.yml', 'log']
set :shared_files, ['config/auth.php']
set :shared_dirs, ['public/media']

# Optional settings:
   set :user, 'deploy'    # Username in the server to SSH to.
   set :port, '22'     	  # SSH port number.

desc "Deploys the current version to the server."
task :deploy => :environment do
  deploy do
    # Put things that will set up an empty directory into a fully set-up
    # instance of your project.
    invoke :'git:clone'
    invoke :'composer'
    invoke :'deploy:link_shared_paths'

    on :launch do
      invoke :'reload_env'
      invoke :'deploy:cleanup'
    end
  end
end

desc "Installing packages via composer"
task :composer do
    command 'composer install -a --no-dev'
end

desc "Reloading nginx and php-fpm"
task :reload_env do
    command 'sudo service php7.1-fpm reload'
    command 'sudo service nginx restart'
end

desc "Rolls back the latest release"
task :rollback => :environment do
  command! %[echo "-----> Rolling back to previous release for instance: #{domain}"]

  # Delete existing sym link and create a new symlink pointing to the previous release
  command %[echo -n "-----> Creating new symlink from the previous release: "]
  command %[ls "#{deploy_to}/releases" -Art | sort | tail -n 2 | head -n 1]
  command! %[ls -Art "#{deploy_to}/releases" | sort | tail -n 2 | head -n 1 | xargs -I active ln -nfs "#{deploy_to}/releases/active" "#{deploy_to}/current"]

  # Remove latest release folder (active release)
  command %[echo -n "-----> Deleting active release: "]
  command %[ls "#{deploy_to}/releases" -Art | sort | tail -n 1]
  command! %[ls "#{deploy_to}/releases" -Art | sort | tail -n 1 | xargs -I active rm -rf "#{deploy_to}/releases/active"]
end

load 'deploy' if respond_to?(:namespace) # cap2 differentiator
Dir['vendor/bundles/*/*/recipes/*.rb'].each { |bundle| load(bundle) }
load Gem.find_files('symfony2.rb').last.to_s

after "deploy:finalize_update" do
  run "sudo setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx #{latest_release}/#{cache_path} #{latest_release}/#{log_path}"
  run "sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx #{latest_release}/#{cache_path} #{latest_release}/#{log_path}"
end

load 'app/config/deploy'
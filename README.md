# WordPress Skeleton

This is simply a skeleton repo for a WordPress site. Use it to jump-start your WordPress site repos, or fork it and customize it to your own liking!

## Assumptions

* WordPress as a Git submodule in `/wp/`
* Custom content directory in `/wp-content/` (cleaner, and also because it can't be in `/wp/`)
* `wp-config.php` in the root (because it can't be in `/wp/`)
* `wp-config.ini` to hold any sensitive config values (not tracked by git)
* Custom `.htaccess` files with security rules

## Quick setup

```
# Clone repo and change git remote to your own
git clone --recursive git@github.com:dmarcelino/WordPress-Skeleton.git
git remote rm origin
git remote add origin <your_git_repo>

# Change WordPress version to your favourite one
cd wp
git checkout <wp_version>  # example: 4.9.1
cd ..

# Create a wp-config.ini and edit it
cp wp-config-sample.ini wp-config.ini

# Add your theme to /wp-content/themes/ or copy one from /wp/
cp -R wp/wp-content/themes/twentyseventeen wp-content/themes/
```

## Extras

* `.dev/fix-wordpress-permissions.sh`: script to fix WP permissions
* `.dev/dump_db.sh`: script to perform a mysqldump using the config from `wp-config.ini`

## About

This version of WordPress Skeleton is inspired on:
* David Winter's [Install and manage WordPress with Git](https://davidwinter.me/install-and-manage-wordpress-with-git/)
* Mark Jaquith's own [WordPress Skeleton](https://github.com/markjaquith/WordPress-Skeleton)
* Steve Grunwell's [Keeping WordPress Under (version) Control with Git](https://stevegrunwell.com/blog/keeping-wordpress-under-version-control-with-git/)
* Gitium's [.gitignore](https://github.com/PressLabs/gitium/blob/4906067abb775f9046ab565669391b32770896a1/gitium/inc/class-git-wrapper.php)

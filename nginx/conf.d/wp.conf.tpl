server {
    listen      80;
    listen      [::]:80;


    server_name mywordpress.local;


    root    /usr/www/html/mywordpress;
    index   index.html index.htm index.php;

    location = /favicon.ico {
        log_not_found off;
        access_log off;
    }

    location = /robots.txt {
        allow all;
        log_not_found off;
        access_log off;
    }

    # WORDPRESS : Rewrite rules, sends everything through index.php and keeps the appended query string intact
    location / {
        try_files $uri $uri/ /index.php?q=$uri&$args;
    }

    # SECURITY : Deny all attempts to access PHP Files in the uploads directory
    location ~* /(?:uploads|files)/.*\.php$ {
        deny all;
    }

    # REQUIREMENTS : Enable PHP Support
    location ~ \.php$ {
        # SECURITY : Zero day Exploit Protection
        try_files $uri =404;
        # ENABLE : Enable PHP, listen fpm sock
        fastcgi_intercept_errors on;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass    phpfpm:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include        fastcgi_params;
        fastcgi_read_timeout 300;
        client_body_buffer_size 10M;
    }

    # PLUGINS : Enable Rewrite Rules for Yoast SEO SiteMap
    rewrite ^/sitemap_index\.xml$ /index.php?sitemap=1 last;
    rewrite ^/([^/]+?)-sitemap([0-9]+)?\.xml$ /index.php?sitemap=$1&sitemap_n=$2 last;


    # SECURITY : Deny all attempts to access hidden files .abcde
    location ~ /\. {
        deny all;
    }

    # PERFORMANCE : Set expires headers for static files and turn off logging.
    location ~* ^.+\.(js|css|swf|xml|txt|ogg|ogv|svg|svgz|eot|otf|woff|mp4|ttf|rss|atom|jpg|jpeg|gif|png|ico|zip|tgz|gz|rar|bz2|doc|xls|exe|ppt|tar|mid|midi|wav|bmp|rtf)$ {
        access_log off; log_not_found off; expires 30d;
    }
}
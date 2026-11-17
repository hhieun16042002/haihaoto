# Image WordPress cho site Ô tô Hải Hà
# Dùng cùng phiên bản với docker-compose.yml đang chạy
FROM wordpress:php8.4-apache

# Cấu hình PHP (giới hạn upload, bộ nhớ)
COPY uploads.ini /usr/local/etc/php/conf.d/uploads.ini

# Copy toàn bộ mã nguồn WordPress (core + theme + plugin + ảnh)
COPY --chown=www-data:www-data wordpress/ /var/www/html/

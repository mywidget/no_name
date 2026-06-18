<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($urls as $url): ?>
    <url>
        <loc><?php echo html_escape($url['loc']); ?></loc>
        <priority><?php echo html_escape($url['priority']); ?></priority>
        <changefreq><?php echo html_escape($url['changefreq']); ?></changefreq>
        <lastmod><?php echo date('Y-m-d'); ?></lastmod>
    </url>
    <?php endforeach; ?>
    
    <?php if (isset($posts)): ?>
    <?php foreach ($posts as $post): ?>
    <url>
        <loc><?php echo base_url('blog/' . $post['slug']); ?></loc>
        <priority>0.6</priority>
        <changefreq>weekly</changefreq>
        <lastmod><?php echo date('Y-m-d', strtotime($post['updated_at'])); ?></lastmod>
    </url>
    <?php endforeach; ?>
    <?php endif; ?>
</urlset>
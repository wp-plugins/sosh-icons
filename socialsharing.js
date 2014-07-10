Share = {
                                facebook: function(purl, ptitle, pimg, text) {
                                url = 'http://www.facebook.com/sharer.php?s=100';
                                url += '&p[title]=' + encodeURIComponent(ptitle);
                                url += '&p[summary]=' + encodeURIComponent(text);
                                url += '&p[url]=' + encodeURIComponent(purl);
                                url += '&p[images][0]=' + encodeURIComponent(pimg);
                                Share.popup(url);
                                },
                                twitter: function(purl, ptitle,prel,pvia) {
                                url = 'https://twitter.com/intent/tweet?';
                                url += 'original_referer='+ encodeURIComponent(purl);
                                url += '&text=' + encodeURIComponent(ptitle);
                                url += '&url=' + encodeURIComponent(purl);
                                url += '&related='+ encodeURIComponent(prel);;
                                url += '&via='+ encodeURIComponent(pvia);;                                 
                                Share.popup(url);
                                },
                                linkedin: function(purl, ptitle) {
                                url = 'http://linkedin.com/shareArticle?mini=true';
                                url += '&title=' + encodeURIComponent(ptitle);
                                url += '&url=' + encodeURIComponent(purl);
                                Share.popup(url);
                                },
                                googleplus: function(purl,ptitle) {
                                url = 'https://plus.google.com/share?';
                                url += 'url=' + encodeURIComponent(purl);
                                url += '?utm_campaign='+ encodeURIComponent(ptitle);
                                url += '&utm_source=goolgeplus';
                                Share.popup(url);
                                },
                                xing: function(purl,ptitle) {
                                url = 'https://www.xing.com/social_plugins/share?';
                                url += 'url=' + encodeURIComponent(purl);
                                url += '&sc_p=xing-share';
                                Share.popup(url);
                                },
                                pinterest: function(purl,ptext,pimg) {
                                url = 'http://pinterest.com/pin/create/button/?';
                                url += 'url=' + encodeURIComponent(purl);
                                url += '&description=' + encodeURIComponent(ptext);
                                url += '&media=' + encodeURIComponent(pimg);
                                Share.popup(url);
                                },
                                tumblr: function(purl,ptitle,ptext) {
                                url = 'https://www.tumblr.com/share/link?';
                                url += 'url=' + encodeURIComponent(purl);
                                url += '&name=' + encodeURIComponent(ptitle);
                                url += '&description=' + encodeURIComponent(ptext);
                                Share.popup(url);
                                },
                                vk: function(purl,ptitle,pimg,ptext) {
                                url = 'http://vk.com/share.php?';
                                url += 'url=' + encodeURIComponent(purl);
                                url += '&title=' + encodeURIComponent(ptitle);
                                url += '&image=' + encodeURIComponent(pimg);
                                url += '&description=' + encodeURIComponent(ptext);
                                Share.popup(url);
                                },
                                mail: function(purl,ptext,ptitle) {
                                ebody = encodeURIComponent(ptext)+'%0D%0A'+'%0D%0A'+'gesehen auf: ' +encodeURIComponent(purl);
                                url = 'mailto:?';
                                url += 'subject=' + encodeURIComponent(ptitle);
                                url += '&body=' + ebody; 
                                Share.popup(url);
                                },
                                popup: function(url) {
                                window.open(url,'','toolbar=0,status=0,width=626, height=436');
                                }
};
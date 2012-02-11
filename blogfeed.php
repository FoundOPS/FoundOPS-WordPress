<?php ?>
<!DOCTYPE html>
<html style="background:none;">
<head runat="server">
    <title> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="wp-content/themes/twentyeleven/style.css" rel="stylesheet" type="text/css" />
    <script src="wp-includes/jquery-1.6.1.min.js" type="text/javascript"></script>
</head>
<body style="background:none;">
    <div id="blog">
        <!-- Load RSS Through Google as JSON using jQuery -->
        <script type="text/javascript">
			function myDateParser(datestr) {
				var year  = datestr.substring(12,17);
				var day   = datestr.substring(5,7);
				var month = datestr.substring(8,11);
				return month + " " + day + " " + year;
			}
			
			function constrain(str,Link){
				if(str.length > 180){
				var s = str.substr(0, 180);
				var words = s.split(' ');
				words[words.length-1] = '';
				str = words.join(' ') + '... <i><a style="color:#488FCD;font-size:14px;font-style:normal;" href="' + Link + '" target="_parent">Read More</a></i>';
				}
				str = str.replace("<strong>", "");
				str = str.replace("</strong>", "");
				return str;
			}
			
            function displayFeed (feedResponse) {
				//define the articles to use
				var article1 = feedResponse.entries[0];
				var article2 = feedResponse.entries[1];
				var article3 = feedResponse.entries[2];
				
				var date1 = myDateParser(article1.publishedDate);
				var date2 = myDateParser(article2.publishedDate);
				var date3 = myDateParser(article3.publishedDate);
				
				var link1 = article1.link;
				var link2 = article2.link;
				var link3 = article3.link;
				
				var title1 = article1.title;
				var title2 = article2.title;
				var title3 = article3.title;
				
				var description1 = constrain(article1.content, link1);
				var description2 = constrain(article2.content, link2);
				var description3 = constrain(article3.content, link3);
			
				//Build formatted feed
				var html  =  '<div id="post1"><a href="'+ link1 +'" target="_parent"><b style="font-size:16px;">' + title1 + '</b></a><br/>';
				html += date1 + '<br/>';
				html += description1 + '</p></div>';
				
				html += '<br/><div id="post2"><a href="'+ link2 +'" target="_parent"><b style="font-size:16px;">' + title2 + '</b></a><br/>';
				html += date2 + '<br/>';
				html += description2 + '</p></div>';
				
				html += '<br/><div id="post3"><a href="'+ link3 +'" target="_parent"><b style="font-size:16px;">' + title3 + '</b></a><br/>';
				html += date3 + '<br/>';
				html += description3 + '</p></div>';
			
				$('#blog').append(html);
            }

            function parseRSS(url, callback) {
				$.ajax({
					url: document.location.protocol + '//ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=10&callback=?&q=' + encodeURIComponent(url),
					dataType: 'json',
					success: function(data) {
						callback(data.responseData.feed);
					}
				});
            }
        
            $(document).ready(function() {              
                parseRSS("http://wp.foundops.com/feed", displayFeed);
            });
        </script>
    </div>
</body>
</html>
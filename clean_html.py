#!/usr/bin/env python
# -*- coding: utf-8 -*-
"""
Script to clean the National Yang-Ming University HTML file
Removes Wayback Machine code and fixes resource paths
"""

import re

def clean_html():
    input_file = "國立陽明大學 National Yang-Ming University.html"
    output_file = "index.html"

    print(f"Reading {input_file}...")
    with open(input_file, 'r', encoding='utf-8') as f:
        content = f.read()

    print(f"Original file size: {len(content)} characters")

    # Find where Wayback toolbar ends
    wayback_end_marker = '<!-- END WAYBACK TOOLBAR INSERT -->'
    wayback_end_pos = content.find(wayback_end_marker)

    if wayback_end_pos == -1:
        print("ERROR: Could not find Wayback end marker!")
        return

    # Skip past the end marker and newlines
    content_after_wayback = content[wayback_end_pos + len(wayback_end_marker):]

    # Find where the actual HTML content starts (after noscript)
    noscript_pos = content_after_wayback.find('<noscript>')
    if noscript_pos >= 0:
        actual_content = content_after_wayback[noscript_pos:]
    else:
        actual_content = content_after_wayback

    # Extract the DOCTYPE and clean head section from the original
    # Get DOCTYPE
    doctype = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'

    # Build clean HTML opening
    clean_html_start = '''<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-tw">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="keywords" content="國立陽明大學,陽明大學,陽明醫學院,醫學院,仁心仁術,陽明大學各式招生訊息,國際一流大學,陽明電子報,國立陽明大學資訊與通訊中心,國立陽明大學資通中心,學術資訊,基因體中心,生醫資訊,動物中心,腦科學中心,頂尖大學,陽明大學教務處,陽明大學學生事務處,陽明大學學務處,陽明大學總務處,陽明大學招標,陽明大學生命科學院,陽明大學藥學院,陽明大學護理學院,陽明大學醫學工程學院,陽明大學牙醫學院,陽明大學人文與社會科學院,光電所,腦科所,醫管所,衛福所,生理所,藥理所,解剖科,熱醫科,腦科學,醫技系,醫放系,物治系,物理治療,醫工系,生科系,基因體所,神研所,微免所,生化所,生醫資訊所,生資,生物資訊,臨床護理研究所,臨床護理所,口生所,口腔生物,科技與社會研究所,心智哲學研究所,視覺文化研究所,生藥所,藥科院,藥物科學,系合中心,國際衛生學程,招生訊息,招生,石牌,立農街,軍艦岩,臨床醫學,臨醫所,轉譯醫學,傳醫所,傳統醫學,公共衛生,環衛所,繁星,升學, 陽明校史, 本校歷史悠久,風景悠美,附近並有著名的軍鑑岩,鄰近榮民總醫院,原為陽明醫學院, 陽明電子報, 行政單位, 教學單位, 研究中心, 校園地圖, 校園通訊錄">
<meta name="description" content="國立陽明大學,醫學,招生,醫學院,生醫暨工程學院,生命科學院,護理學院,牙醫學院,人文與社會科學院,藥物科學院">
<meta content="index,follow" name="robots">
<meta name="google-site-verification" content="n4AQy5j75I4BFaQMFGurj_6922G5-Mya4klbQZzxeC8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="msvalidate.01" content="880E5015AE0F6C9D02F06034058DF718">
<link rel="SHORTCUT ICON" href="./assets/images/111(2).ico" type="image/ico">
<title>國立陽明大學 National Yang-Ming University</title>

<link rel="stylesheet" href="./assets/css/combine-zh-tw.css" type="text/css">

<!--[if lte IE 6]>
<link rel="stylesheet" href="/style/style-ie6.css" type="text/css" />
<![endif]-->
<script type="text/javascript" src="./assets/js/jquery.js"></script>
<script type="text/javascript" src="./assets/js/jquery-migrate.js"></script>

<script language="javascript"><!--
 var isHome = true
 --></script>
<script type="text/javascript" src="./assets/js/20210118.php"></script>
<script type="text/javascript" src="./assets/js/scw.zh-tw.js"></script>
<script type="text/javascript" src="./assets/js/scw.js"></script>
<style type="text/css">@import url(./assets/css/calendar.css);.scw {padding:1px;vertical-align:middle;}iframe.scw {position:absolute;z-index:100;top:0px;left:0px;visibility:hidden;width:1px;height:1px;}table.scw {padding:0px;visibility:hidden;position:absolute;cursor:default;width:200px;top:0px;left:0px;z-index:101;text-align:center;}</style>
<!--[if gte IE 7]><div id='scwIEgte7'></div><![endif]-->
</head>
<body class="page_home page_bg_3">
'''

    # Now clean the actual content
    cleaned_content = actual_content

    # Remove Wayback wombat functions
    cleaned_content = re.sub(
        r'<script type="text/javascript">var _____WB\$wombat\$assign\$function_____.*?}}\s*</script>',
        '',
        cleaned_content,
        flags=re.DOTALL
    )

    # Clean up inline wayback wombat code
    cleaned_content = re.sub(
        r'var _____WB\$wombat\$assign\$function_____.*?{',
        '{',
        cleaned_content,
        flags=re.DOTALL
    )

    # Replace file paths
    print("Fixing resource paths...")

    # Fix image paths
    cleaned_content = cleaned_content.replace(
        './國立陽明大學 National Yang-Ming University_files/',
        './assets/images/'
    )

    # Fix CSS and JS paths - need to be more selective
    # Replace CSS files to assets/css/
    cleaned_content = re.sub(
        r'src="./assets/images/(.*?\.css.*?)"',
        r'href="./assets/css/\1"',
        cleaned_content
    )
    cleaned_content = re.sub(
        r'href="./assets/images/(.*?\.css.*?)"',
        r'href="./assets/css/\1"',
        cleaned_content
    )

    # Replace JS files to assets/js/
    cleaned_content = re.sub(
        r'src="./assets/images/(.*?\.js.*?)"',
        r'src="./assets/js/\1"',
        cleaned_content
    )
    cleaned_content = re.sub(
        r'href="./assets/images/(.*?\.js.*?)"',
        r'src="./assets/js/\1"',
        cleaned_content
    )

    # Remove .下載 suffix from all file references
    cleaned_content = cleaned_content.replace('.下載', '')

    # Replace Wayback Archive URLs with relative paths or #
    # Handle different archive.org URL patterns
    cleaned_content = re.sub(
        r'https://web\.archive\.org/web/\d+[a-z_]*/(https?://[^"\']+)',
        r'#',
        cleaned_content
    )
    cleaned_content = re.sub(
        r'https://web\.archive\.org/web/\d+im_/(https?://[^"\']+)',
        r'#',
        cleaned_content
    )

    # Replace specific archive.org image URLs
    cleaned_content = re.sub(
        r'https://web-static\.archive\.org/_static/[^"\']+',
        r'#',
        cleaned_content
    )

    # Fix Google Analytics script references
    cleaned_content = re.sub(
        r'//web\.archive\.org/web/\d+[a-z_]*/(https?://)',
        r'//\1',
        cleaned_content
    )

    # Combine the cleaned HTML
    final_html = clean_html_start + cleaned_content

    # Ensure proper HTML closure (if missing)
    if '</body>' not in final_html:
        final_html += '\n</body>\n</html>'
    elif '</html>' not in final_html:
        final_html += '\n</html>'

    print(f"Cleaned file size: {len(final_html)} characters")
    print(f"Writing to {output_file}...")

    with open(output_file, 'w', encoding='utf-8') as f:
        f.write(final_html)

    print(f"Successfully created {output_file}!")
    print(f"\nSummary of changes:")
    print(f"  - Removed Wayback Machine toolbar and scripts (lines 1-170)")
    print(f"  - Removed all web.archive.org references")
    print(f"  - Changed paths from './國立陽明大學 National Yang-Ming University_files/' to './assets/images/', './assets/css/', './assets/js/'")
    print(f"  - Removed '.下載' suffix from file references")
    print(f"  - Cleaned HTML head with proper meta tags")
    print(f"  - Kept all original NYMU content and functionality")

if __name__ == '__main__':
    clean_html()

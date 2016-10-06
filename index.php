<?php
    // Set the number of columns to display on page load.
    $defaultColumnsCount = 2;

    // The search engines to use.
    $search = [
        [
            'name' => 'bing',
            'baseUrl' => 'http://www.bing.com',
            'searchUrl' => 'http://www.bing.com/search?q={searchTerm}'
        ], [
            'name' => 'duckduckgo',
            'baseUrl' => 'https://duckduckgo.com',
            'searchUrl' => 'https://duckduckgo.com/?q={searchTerm}&ia=videos'
        ]
    ];

    $external = [
        'eBay' => 'http://my.ebay.co.uk/ws/eBayISAPI.dll?MyEbay&gbh=1&CurrentPage=MyeBayAllSelling&ssPageName=STRK:ME:LNLK:MESX',
        'Amazon' => 'https://amazon.co.uk',
        'Hotmail' => 'https://hotmail.com',
        'easyFundraising' => 'https://easyfundraising.org.uk',
        'Confluence' => 'https://easyfundraising.atlassian.net/wiki/#all-updates',
        'JIRA' => 'https://easyfundraising.atlassian.net/secure/MyJiraHome.jspa',
        'Bitbucket' => 'https://bitbucket.org/'
    ];
?>

<html>
<head>
    <title>Multi search</title>
    <style>
        #searchbar {
            width: 100%;
            padding: 20px;
            margin: 0 auto;
            text-align: center;
            border-bottom: 1px solid gray;
        }
        .column {
            width: <?=(100/count($search))?>%;
            min-height: 80%;
            float: left;
        }
        iframe {
            width: 100%;
            min-height: 100%;
            height: 100%;
            margin-top: 15px;
        }
        input, button, select {
            padding: 5px;
        }
        #external-links {
            text-align: right;
        }
        #external-links a {
            color: black;
            padding: 5px;
        }
        .tab a {
            padding: 5px;
            background: ghostwhite;
            border: 1px solid lightsteelblue;
            cursor: pointer;
            margin: 5px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        // Search engines details populated in javascript.
        var searchEngines = [
            <?php foreach ($search as $s): ?>
                [
                    '<?=$s["name"]?>',
                    '<?=$s["searchUrl"]?>'
                ],
            <?php endforeach ?>
        ];
    </script>
    <script src="script.js"></script>
</head>
<body>
    <header>
        <div id="internal-blocks">
            <div class="tab">
                <a id="search" class="open">Search</a>
                <a id="panel" class="open">Panel</a>
            </ul>
        </div>
        <div id="external-links">
            <?php foreach ($external as $name => $link): ?>
                <a href="<?=$link?>" target="_blank"><?=$name?></a>
            <?php endforeach ?>
        </div>
    </header>
    <section id="search">
        <div id="searchbar">
            <span>Search</span>
            <input type="text" id="searchTerm"> 
            <button id="go" tabindex="1">Go</button> <a id="legend">I</a>
            <select id="searchCount">
                <?php for ($i = count($search); $i > 0; $i--): ?>
                    <option value="<?=$i?>" <?=($i == $defaultColumnsCount) ? 'selected=selected' : ''?>><?=$i?></option>
                <?php endfor ?>
            </select>
            Per column
        </div>
        <div id="searchResult">
            <?php foreach ($search as $index => $s): ?>
                <div class="column" style="width: <?=100/$defaultColumnsCount?>%">
                    <h3><?=$s['name']?></h3>
                    <iframe src="" id="<?=$s['name']?>Search"></iframe>
                </div>
            <?php endforeach ?>
        </div>
    </section>
    <section id="panel">
        <div id="tab" class="tab">
            <a>Ali Express</a>
            <a>Ali Baba</a>
        </div>
        <iframe src="https://www.aliexpress.com/" id="ali-express"></iframe>
        <iframe src="https://www.alibaba.com/" id="ali-baba"></iframe>
    </section>
</body>
</html>
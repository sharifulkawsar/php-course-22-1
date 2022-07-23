<!doctype html>
<html lang="en-US">
<head>
    <title>Caddy Browse</title>

    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Caddy Browse" />
    <meta name="theme-color" content="black" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="Caddy Browse">
    <meta name="msapplication-TileImage" content="/icons/favicon.svg" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />

    <link rel="alternate" hreflang="en" hreftype="text/html" />
    <link rel="manifest" href="/manifest.json" />
    <link rel="apple-touch-icon" href="/icons/favicon.svg" />
    <link rel="shortcut icon" type="image/x-icon" href="/icons/favicon.svg" />

    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous"
        as="style" onload="this.onload=null;this.rel='stylesheet'" />

    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
    </noscript>

    <link rel="stylesheet" href="/style.css" />
</head>
<body>
    <main class="containter-fluid mb-3">
        <header class="fixed-top w-100 bg-dark">
            <nav aria-label="breadcrumb">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-12">
                            <ol class="bg-dark breadcrumb p-sm-3">
                                {{.Path}}
                            </ol>
                        </div>
                        <div class="col-md-3 col-8 p-md-3">
                            <form id="search-form" class="form-inline">
                                <div class="form-group">
                                    <span class="p-1">
                                        <svg class="i-search" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            viewBox="0 0 32 32" fill="none" stroke="currentcolor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2">
                                                <circle cx="14" cy="14" r="12" />
                                                <path d="M23 23 L30 30" />
                                        </svg>
                                    </span>
                                    <input class="w-75 w-md-100 bg-dark text-white" id="search"
                                        placeholder="search..." name="filter" type="search" onkeyup="doSearch()" />
                                </div>
                            </form>
                        </div>
                        <div class="col-4 d-flex d-sm-none">
                            <h5><span class="text-primary">{{len .Items}}</span> Total</h5>
                        </div>
                    </div>
                </div>
           </nav>
        </header>

        <div class="mx-auto p-3">
            <div class="row bg-dark p-3 mb-3 d-none d-sm-flex">
                <div class="col-3"><h5><span class="text-primary">{{len .Items}}</span> Total</h5></div>
                <div class="col-3"><h5><span class="text-primary">{{.NumDirs}}</span> Dirs</h5></div>
                <div class="col-3"><h5><span class="text-primary">{{.NumFiles}}</span> Files</h5></div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-dark table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">
                                <h5 class="h5">
                                    <span data-toggle="tooltip" data-placement="top" title="order by file name">
                                        <a id="link-name">File</a>
                                    <span>
                                </h5>
                            </th>
                            <th scope="col">
                                <h5 class="h5">
                                    <span data-toggle="tooltip" data-placement="top" title="order by file size">
                                        <a id="link-size">Size</a>
                                    </span>
                                </h5>
                            </th>
                            <th scope="col">
                                <h5 class="h5">
                                    <span data-toggle="tooltip" data-placement="top" title="order by file mod date">
                                        <a id="link-time">Date</a>
                                    </span>
                                </h5>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="datatable">
                        {{range .Items}}
                        <tr>
                            {{if .IsDir}}
                                <td>
                                    <span class="d-none d-sm-inline pr-1">
                                        <svg class="i-folder" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 32 32" fill="none" stroke="currentcolor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2">
                                                <path d="M2 26 L30 26 30 7 14 7 10 4 2 4 Z M30 12 L2 12" />
                                        </svg>
                                    </span>
                                    <a href="{{html .URL}}">
                                        <strong class="item-searchable dir-color">{{html .Name}}</strong>
                                    </a>
                                </td>
                                <td>
                                    <span>
                                        <svg class="i-minus" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 32 32" fill="none" stroke="currentcolor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2">
                                                <path d="M2 16 L30 16" />
                                        </svg>
                                    </span>
                                </td>
                            {{else}}
                                <td>
                                    <span class="d-none d-sm-inline pr-1">
                                        <svg class="i-file" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 32 32" fill="none" stroke="currentcolor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2">
                                                <path d="M6 2 L6 30 26 30 26 10 18 2 Z M18 2 L18 10 26 10" />
                                        </svg>
                                    </span>
                                    <a href="{{html .URL}}" target="_blank">
                                        <span class="item-file">{{html .Name}}</span>
                                    </a>
                                </td>
                                <td>
                                    <span class="item-size">{{.Size}}</span>
                                </td>
                            {{end}}
                            <td>
                                <span class="item-date">{{.ModTime}}</span>
                            </td>
                        </tr>
                        {{end}}
                    </tbody>
                </table>
            </div>
        </div>

        <hr class="my-my-44" />

        <footer class="pb-5">
            <div class="container">
                <p class="text-center">
					<em class="small text-secondary">
					Caddy is a registered trademark of Light Code Labs, LLC.
					</em>
                </p>
            </div>
        </footer>
    </main>

    <a id="back-to-top" href="#" class="btn btn-secondary btn-lg back-to-top" role="button">
        <svg id="i-chevron-top" xmlns="http://www.w3.org/2000/svg"width="32" height="32"
            viewBox="0 0 32 32" fill="none" stroke="currentcolor"
            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M30 20 L16 8 2 20" />
        </svg>
    </a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"
        integrity="sha256-Xt8pc4G0CdcRvI0nZ2lRpZ4VHng0EoUDMlGcBSQ9HiQ=" crossorigin="anonymous">
    </script>

    <script src="/app.js"></script>
</body>
</html>

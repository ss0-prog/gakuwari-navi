// JavaScript Document
$(document).ready(function(){
	//スクロール :not(.menuBtn)
	$('.menuBtn').click(function() {
		$('.navi').toggleClass('open');
		$('.Btn-navi').toggleClass('open');
		$('.navi-background').toggleClass('close');
		return false;
	});
	$('.navi-background').click(function() {
		$('.navi').toggleClass('open');
		$('.Btn-navi').toggleClass('open');
		$('.navi-background').toggleClass('close');
		return false;
	});
$(function() {
	//ページ内スクロール
	//alert($(location).attr('href'));
    /*$('a[href^=#]:not(.qa,#menuBtn)').click(function(){
		var href= $(this).attr("href");
		if($('header .menu').css('display') =='block'){
			$("header .menu").slideToggle(200);
			$("#menu-icon").toggleClass("close");
		}
		smoothscroll(href);
		return false;
	});
	$("#menuBtn").click(function() {
		$("header .menu").slideToggle(200);
		$("#menu-icon").toggleClass("close");
		return false;
	});
	$(".seminar dt").click(function() {
		$(this).next().slideToggle();
		$(this).toggleClass("close");
	});*/

});
	/*$(window).scroll(function () {
		if ($(this).scrollTop() > 500) {
			$('.fadein').addClass('action');
		} else {
			$('.fadein').removeClass('action');
		}
	});*/

	//ボタン単品の話//
	$('.menuBtn').click(function() {
		$('.menu').toggleClass('open');
		$('.navi-background').toggleClass('open');
		$('#navicover').toggleClass('view');
		$('.navi').toggleClass('close');
		$('.Btn-navi').toggleClass('close');
		return false;
	});
	//ボタン単品の話//
	
	$('#navicover').click(function() {
		$('.menu').toggleClass('open');
		$('.navi-background').toggleClass('open');
		$('#navicover').toggleClass('view');
		$('.navi').toggleClass('close');
		return false;
	});

	//ボタン以外の場所をクリックしてもの話//
	$('.navi-background').click(function() {
		$('.menu').toggleClass('open');
		$('.navi-background').toggleClass('open');
		$('#navicover').toggleClass('view');
		$('.navi').toggleClass('close');
		$('.Btn-navi').toggleClass('close');
		return false;
	});
	//ボタン以外の場所をクリックしてもの話//



});


$(function(){
	$('a[href^=#]').click(function(){
		var speed = 700;
		var href= $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top;
		$("html, body").animate({scrollTop:position}, speed, "swing");
		return false;
	});
});


function dropsort() {
    var browser = document.sort_form.sort.value;
    location.href = browser
}


function dropsort02() {
    var target = document.sort_form.sort.value;
    if(target == 'all'){
    	$('section.member').removeClass('hidden');
    } else {
    	var targetclass = 'section.'+target;
    	$('section.member').addClass('hidden');
    	$(targetclass).removeClass('hidden');
    }
}

function dropsort03(key) {
    var target = key;
	var targetclass = 'section.'+target;
	$('section.member').addClass('hidden');
	$(targetclass).removeClass('hidden');
	$('#sort').val(target);
}



$(function () {
    $(".slide-global-nav-img").slick({
        arrows: true,
        swipe: true,
        // 1個の幅はCSSで固定(.slick-slide の width)。画面幅に収まる個数だけが並ぶ
        // (個数で割ると、広い画面でアイコンの間隔が開きすぎるため)
        variableWidth: true,
        slidesToScroll: 3,
        prevArrow: '<button class="slide-arrow-nav prev-arrow-nav"></button>',
        nextArrow: '<button class="slide-arrow-nav next-arrow-nav"></button>',
        responsive: [
            {
                breakpoint: 1024, // タブレット向け: 1回に送る個数
                settings: { slidesToScroll: 5 },
            },
        ],
    });

    // 右端のアイコンが半分だけ見えて切れないよう、幅に「全体が入る個数」を求めて、その個数で幅を等分する
    // (1個の最小幅: PC 90px、スマホ 66px)
    const $nav = $(".slide-global-nav-img");
    function fitNavIcons() {
        const list = $nav.find(".slick-list")[0];
        if (!list) {
            return;
        }
        const width = list.clientWidth;
        const minWidth = window.innerWidth <= 680 ? 66 : 90;
        const count = Math.max(1, Math.floor(width / minWidth));
        $nav[0].style.setProperty("--navw", (width / count) + "px");
        $nav.slick("setPosition");
    }
    fitNavIcons();
    $(window).on("resize", fitNavIcons);
});


$(function () {
	$(".slide-recommend-img").slick({
		arrows: true,
		autoplay: true,
		adaptiveHeight: false,
		centerMode: false, // 端のスライドが半分切れて見えないよう、全体が見えるものだけを並べる
		dots: true,
		autoplaySpeed: 7000,
		slidesToShow: 2,   // PC: 2枚を並べて表示(3枚だと小さくて読みにくい)
		slidesToScroll: 1,
        speed: 1000,
		prevArrow: '<button class="reco-slick-arrow reco-slick-prev" aria-label="前へ"></button>',
        nextArrow: '<button class="reco-slick-arrow reco-slick-next" aria-label="次へ"></button>',
		responsive: [
			{
				// 画面幅900px以下(タブレット): 1枚を大きく
				breakpoint: 900,
				settings: {
					slidesToShow: 1,
				}
			},
			{
				// 画面幅698px以下(スマホ): 1枚、スワイプで操作(矢印なし)
				breakpoint: 698,
				settings: {
					slidesToShow: 1,
					arrows: false,
				}
			}
		]
	});
});



document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll('.bseyifbslink'); // .bseyifbslinkを持つ全要素を取得

    function checkVisibility() {
        elements.forEach(element => {
            const rect = element.getBoundingClientRect();
           
            if (rect.top < window.innerHeight && rect.bottom >= 0) {
                element.classList.add('visible');
            }
        });
    }

   
    checkVisibility();

   
    window.addEventListener('scroll', checkVisibility);
});

// サイドバーの検索
$(document).ready(function() {
    const toggleButton = $(".toggle-advanced-search");
    const advancedSearch = $(".advanced-search");

    toggleButton.on("click", function() {
        advancedSearch.toggleClass("active");
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const toggleButtons = document.querySelectorAll(".header-submenu-toggle-btn");

    toggleButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault(); 

            const parentLi = this.closest("li");
            if (!parentLi) return;

            const submenu = parentLi.querySelector(".service-submenu");

            if (submenu) {
                const isOpen = submenu.classList.contains("open");
                
                // すべてのサブメニューを閉じる
                document.querySelectorAll(".service-submenu.open").forEach(menu => {
                    menu.classList.remove("open");
                });
                
                // クリックしたメニューだけ開く
                if (!isOpen) {
                    submenu.classList.add("open");
                }
            }

            this.classList.toggle("active");
        });
    });

    // メニュー外をクリックしたら閉じる処理
    document.addEventListener("click", function (event) {
        const openSubmenus = document.querySelectorAll(".service-submenu.open");
        openSubmenus.forEach(submenu => {
            if (!submenu.contains(event.target) && !event.target.closest(".header-submenu-toggle-btn")) {
                submenu.classList.remove("open");
            }
        });
    });
});






// レスポンシブ698pxのグローバルナビ









// アイコン列のラベルは、5文字で「...」に省略せず、CSS(media.css / style0.css)で折り返して全文を見せる
// (省略すると全文が出るのはホバー時だけで、スマホでは読めないため)



	
//nav-links//
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".nav-links a").forEach(link => {
        link.addEventListener("mouseenter", function () {
            this.classList.add("hover-effect");
        });

        link.addEventListener("mouseleave", function () {
            this.classList.remove("hover-effect");
        });
    });
});


//current.js//
document.addEventListener("DOMContentLoaded", function () {
    let currentPath = window.location.pathname; // 現在のページのパス

    // 検索結果(/?s=...)は、パスがトップページと同じなので「現在地」を付けない
    let params = new URLSearchParams(window.location.search);
    if (params.has("s") || params.has("post_type")) {
        return;
    }

    let navLinks = document.querySelectorAll(".nav-links a");

    navLinks.forEach(link => {
        let linkPath = new URL(link.href).pathname; // 各リンクのパスを取得

        if (currentPath === linkPath) { // 完全一致する場合のみ適用
            link.classList.add("current");
        }
    });
});









document.addEventListener("DOMContentLoaded", function() {
    let postsPerPage;
    let removedPosts = [];            // スライダーに数えさせない余剰カード(取り外して保管)
    let lastWidth = window.innerWidth; // 幅が変わったときだけ再構築するための記録

    function updatePostsPerPage() {
        const $slider = $('.new-posts-slider');

        // 1) slickを破棄し、取り外していたカードを元の順序で戻す
        if ($slider.hasClass('slick-initialized')) {
            $slider.slick('unslick');
        }
        if (removedPosts.length) {
            $slider.append(removedPosts);
            removedPosts = [];
        }

        if (window.innerWidth > 1024) {
            // カード幅230px+間隔10pxで、一覧の幅にちょうど入る枚数(最大10枚)
            const listWidth = document.querySelector('.new-posts-list').clientWidth;
            postsPerPage = Math.min(10, Math.max(3, Math.floor((listWidth + 10) / 240)));
        } else if (window.innerWidth >= 768) {
            postsPerPage = 4;
        } else {
            postsPerPage = 8;
        }

        const posts = document.querySelectorAll('.new-post-item');
        posts.forEach((post, index) => {
            post.style.display = index < postsPerPage ? 'block' : 'none';
        });

        initializeSlider();
    }

    function initializeSlider() {
        const $slider = $('.new-posts-slider');

        if (window.innerWidth <= 1024) {
            // 表示しないカードはslickに渡す前に取り外す
            // (残すと空白のスライドとして数えられ、最後に何も表示されないページができる)
            const hidden = $slider.children('.new-post-item').filter(function (index) {
                return index >= postsPerPage;
            });
            removedPosts = hidden.detach().toArray();

            let slidesToShow;

            if (window.innerWidth <= 680) {
                slidesToShow = 2;
            } else {
                slidesToShow = 4; // 681〜1024pxは4枚表示
            }

            $slider.slick({
                slidesToShow: slidesToShow,
                slidesToScroll: slidesToShow,
                dots: true,
                arrows: window.innerWidth > 680, // スマホ(680px以下)は矢印なし(スワイプで操作)
                infinite: true,                  // 最後までスワイプしたら最初に戻る
                autoplay: false,
                appendDots: $('.new-posts-dots')
            });
        }
        // 1024pxより大きい場合は、updatePostsPerPageでslickを破棄済み(スライダーなし)
    }

    updatePostsPerPage();

    window.addEventListener("resize", function() {
        // スマホはスクロールでアドレスバーが出入りするたびにresizeが発生する。
        // 幅が変わっていない場合は何もしない(スライダーが先頭に戻るのを防ぐ)
        if (window.innerWidth === lastWidth) {
            return;
        }
        lastWidth = window.innerWidth;
        updatePostsPerPage();
    });
});




//お気に入り実装//
function MakeShop_afterListFavoriteEntry(data) {
    if (!data.result) {
        data.method.modal(data.error.message);
        return false;
    }
    $('a[href="' + data.source + '"]').addClass('hide').siblings('.favorite-on').removeClass('hide');
    return false;
}
function MakeShop_afterListFavoriteRemove(data) {
    if (!data.result) {
        data.method.modal(data.error.message);
        return false;
    }
    $('a[href="' + data.source + '"]').addClass('hide').siblings('.favorite-off').removeClass('hide');
    return false;
}


// ヘッダーのロゴと検索バーを画面上部に固定する
//  ・固定すると元の場所が空くので、バーの高さを --hh に入れ、下のナビの上に同じ高さの余白を取る(CSS側)
//  ・少しスクロールしたら is-stuck を付け、バーを小さく・影付きにする(CSS側)
document.addEventListener("DOMContentLoaded", function () {
    const bar = document.querySelector(".head-text");
    if (!bar) {
        return;
    }
    // 余白に使うのは「縮む前(is-stuck なし)」の高さ。スクロール途中で読み込んだり、縮むアニメーションの最中に
    // 測ったりすると小さい値になり、ページの上へ戻ったときにナビがバーの裏に潜ってしまうため、
    // アニメーションを止め、is-stuck を外して測ってから、元に戻す
    function setHeight() {
        const wasStuck = bar.classList.contains("is-stuck");
        bar.classList.add("no-anim");
        bar.classList.remove("is-stuck");
        const h = bar.offsetHeight; // 読み取りで、その場でレイアウトが計算される
        if (wasStuck) {
            bar.classList.add("is-stuck");
        }
        bar.classList.remove("no-anim");
        document.documentElement.style.setProperty("--hh", h + "px");
    }

    function onScroll() {
        bar.classList.toggle("is-stuck", window.scrollY > 10);
    }
    setHeight();
    onScroll();
    window.addEventListener("load", setHeight);
    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(setHeight); // Webフォントの読み込みで高さが変わることがあるため
    }
    window.addEventListener("resize", setHeight);
    window.addEventListener("scroll", onScroll, { passive: true });
});


// グローバルナビ(TOP・学割カテゴリ一覧など)が画面から外れたら、固定バーのロゴの横に同じリンクを出す
//  ・ナビのコピーをバーに入れておき、元のナビが見えなくなったら nav-in-bar を付けて表示する(CSS側)
//  ・元のナビが見えている間は、バーには出さない
document.addEventListener("DOMContentLoaded", function () {
    const bar = document.querySelector(".head-text");
    const nav = document.querySelector(".nav-links");
    const cont = bar && bar.querySelector(".head-cont");
    if (!bar || !nav || !cont || !("IntersectionObserver" in window)) {
        return;
    }
    // current.js で付いた「現在地」の表示も一緒にコピーされる(このスクリプトは current.js より後に実行される)
    const clone = nav.cloneNode(true);
    clone.classList.add("nav-links-compact");
    clone.setAttribute("aria-label", "グローバルナビ(固定バー)");
    cont.insertBefore(clone, cont.querySelector("form"));

    new IntersectionObserver(function (entries) {
        const e = entries[0];
        // 判定の範囲は、上端から64px内側(固定バーの下)。元のナビがその範囲より上にあれば
        // (バーに隠れた場合も含む)バーに出す。範囲より下にあるとき(ページの上など)は出さない
        bar.classList.toggle("nav-in-bar", !e.isIntersecting && e.boundingClientRect.bottom <= 64);
    }, { rootMargin: "-64px 0px 0px 0px" }).observe(nav);
});


// フッターの「TOP」ボタン: ページの先頭へなめらかに戻る(「視差効果を減らす」設定のときは、すぐに戻る)
document.addEventListener("DOMContentLoaded", function () {
    const button = document.getElementById("gw-page-top");
    if (!button) {
        return;
    }
    button.addEventListener("click", function (event) {
        event.preventDefault();
        const reduce = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;
        window.scrollTo({ top: 0, behavior: reduce ? "auto" : "smooth" });
    });
});


// 日本地図(地域から探す): 地図の地方と、右の一覧の同じ地方を、同時に色づける
document.addEventListener("DOMContentLoaded", function () {
    const map = document.querySelector(".gw-map");
    if (!map) {
        return;
    }
    const items = map.querySelectorAll("[data-region]");
    function highlight(region) {
        items.forEach(function (el) {
            el.classList.toggle("is-hover", el.getAttribute("data-region") === region);
        });
    }
    function clear() {
        items.forEach(function (el) {
            el.classList.remove("is-hover");
        });
    }
    items.forEach(function (el) {
        const region = el.getAttribute("data-region");
        el.addEventListener("mouseenter", function () { highlight(region); });
        el.addEventListener("mouseleave", clear);
        el.addEventListener("focus", function () { highlight(region); });
        el.addEventListener("blur", clear);
    });
});


// 記事ページのシェア・ブックマーク: リンクのコピー・端末の共有・ブックマーク(この端末のブラウザに保存)
document.addEventListener("DOMContentLoaded", function () {
    const KEY = "gwBookmarks";

    function readList() {
        try {
            const list = JSON.parse(localStorage.getItem(KEY) || "[]");
            return Array.isArray(list) ? list : [];
        } catch (e) {
            return [];
        }
    }

    function writeList(list) {
        try {
            localStorage.setItem(KEY, JSON.stringify(list));
            return true;
        } catch (e) {
            return false;
        }
    }

    document.querySelectorAll(".gw-share").forEach(function (box) {
        const url = box.dataset.url;
        const title = box.dataset.title;
        const note = box.querySelector(".gw-share__note");
        let timer = null;

        function say(text) {
            note.textContent = text;
            clearTimeout(timer);
            timer = setTimeout(function () {
                note.textContent = "";
            }, 2200);
        }

        function copyByTextarea() {
            const ta = document.createElement("textarea");
            ta.value = url;
            ta.setAttribute("readonly", "");
            ta.style.position = "fixed";
            ta.style.opacity = "0";
            document.body.appendChild(ta);
            ta.select();
            let ok = false;
            try {
                ok = document.execCommand("copy");
            } catch (e) {
                ok = false;
            }
            document.body.removeChild(ta);
            say(ok ? "リンクをコピーしました" : "コピーできませんでした");
        }

        const copy = box.querySelector(".gw-share__copy");
        copy.hidden = false;
        copy.addEventListener("click", function () {
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(function () {
                    say("リンクをコピーしました");
                }, copyByTextarea);
                return;
            }
            copyByTextarea();
        });

        const native = box.querySelector(".gw-share__native");
        if (navigator.share) {
            native.hidden = false;
            native.addEventListener("click", function () {
                navigator.share({ title: title, url: url }).catch(function () {});
            });
        }

        const mark = box.querySelector(".gw-share__bookmark");
        const icon = mark.querySelector("i");
        const label = mark.querySelector("span");
        mark.hidden = false;

        function paint(on) {
            mark.setAttribute("aria-pressed", on ? "true" : "false");
            mark.classList.toggle("is-on", on);
            icon.className = on ? "fa fa-bookmark" : "fa fa-bookmark-o";
            label.textContent = on ? "ブックマーク済み" : "ブックマーク";
        }

        paint(readList().some(function (item) {
            return item.url === url;
        }));

        mark.addEventListener("click", function () {
            const list = readList();
            const index = list.findIndex(function (item) {
                return item.url === url;
            });
            if (index >= 0) {
                list.splice(index, 1);
            } else {
                list.unshift({ url: url, title: title, time: Date.now() });
            }
            if (!writeList(list)) {
                say("この端末では、ブックマークを保存できません");
                return;
            }
            paint(index < 0);
            say(index < 0 ? "ブックマークしました" : "ブックマークを外しました");
        });
    });
});

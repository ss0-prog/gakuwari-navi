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
		console.log('move');
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
        slidesToShow: 11, // 初期設定：PC向け
        slidesToScroll: 3,
        prevArrow: '<button class="slide-arrow-nav prev-arrow-nav"></button>',
        nextArrow: '<button class="slide-arrow-nav next-arrow-nav"></button>',

        // レスポンシブ対応設定
        responsive: [
            {
                breakpoint: 1024, // タブレット向け
                settings: {
                    slidesToShow: 8,
                    slidesToScroll: 5,
                    centerMode: true,
                    centerPadding: "10%",
                },
            },
            {
                breakpoint: 768, // 中画面（スマホ前）向け
                settings: {
                    slidesToShow: 7,
                    slidesToScroll: 5,
                    centerMode: false,
                    centerPadding: "0",
                },
            },
            {
                breakpoint: 480, // スマホ向け
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    centerMode: false,
                    centerPadding: "0",
                },
            },
        ],
    });
});








$(function () {
	$(".slide-recommend-img").slick({
		arrows: true,
		autoplay: true,
		adaptiveHeight: false,
		centerMode: true, 
		centerPadding: "30%",
		dots: true,
		autoplaySpeed: 7000,
		slidesToShow: 1,  
        speed: 1000,
		prevArrow: '<button class="reco-slick-arrow reco-slick-prev"></button>',
        nextArrow: '<button class="reco-slick-arrow reco-slick-next"></button>',
		responsive: [
			{
				// 画面幅が1290px以上
				breakpoint: 1290,
				settings: {
					arrows: true,
					centerMode: true,
					centerPadding: "20%", 
					slidesToShow: 1,
					dots: true,
					autoplay: true,
					autoplaySpeed: 7000,
					speed: 1000,
					prevArrow: '<button class="reco-slick-arrow reco-slick-prev"></button>',
					nextArrow: '<button class="reco-slick-arrow reco-slick-next"></button>',
				}
			},
			{
				// 画面幅698px
				breakpoint: 698,
				settings: {
					arrows: false,
					centerMode: false,
					centerPadding: "0%", 
					slidesToShow: 1,
					dots: true,
					autoplay: true,
					autoplaySpeed: 7000,
					speed: 1000,
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









document.addEventListener("DOMContentLoaded", function() {
	document.querySelectorAll(".slide-global-nav-img a p").forEach(container => {
	  	const text = container.textContent.trim(); 
	  	container.style.whiteSpace = "nowrap"; 
		const initialHeight = container.clientHeight; 
	
		container.style.whiteSpace = "normal"; 
		const expandedHeight = container.clientHeight; 
	
		if (text.length > 6 || (text.length === 6 && initialHeight < expandedHeight)) {
			container.dataset.fullText = text; 
			container.textContent = text.slice(0, 5) + "...";
	
			container.addEventListener("mouseenter", function() {
			container.textContent = container.dataset.fullText;
			});
	
			container.addEventListener("mouseleave", function() {
			container.textContent = text.slice(0, 5) + "...";
			});
	  	}
	});
});
  

	



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

    function updatePostsPerPage() {
        if (window.innerWidth >= 1500) {
            postsPerPage = 8;
        } else if (window.innerWidth >= 1400) {
            postsPerPage = 6;
        } else if (window.innerWidth >= 1024) {
            postsPerPage = 6;
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
        if (window.innerWidth <= 1024) {
            // slickが初期化済みなら一旦破棄
            if ($('.new-posts-slider').hasClass('slick-initialized')) {
                $('.new-posts-slider').slick('unslick');
            }

            let slidesToShow;

            if (window.innerWidth <= 680) {
                slidesToShow = 2;
            } else {
                slidesToShow = 4; // 681〜880pxまでは4枚表示
            }

            $('.new-posts-slider').slick({
                slidesToShow: slidesToShow,
                slidesToScroll: slidesToShow,
                dots: true,
                arrows: true,
                infinite: false,
                autoplay: false,
                appendDots: $('.new-posts-dots')
            });
        } else {
            // 880pxより大きい場合、slickを無効化
            if ($('.new-posts-slider').hasClass('slick-initialized')) {
                $('.new-posts-slider').slick('unslick');
            }
        }
    }

    updatePostsPerPage();

    window.addEventListener("resize", function() {
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
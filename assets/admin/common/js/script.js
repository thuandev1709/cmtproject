
//smartRollover.js
function smartRollover() {
    if(document.getElementsByTagName) {
        var images = document.getElementsByTagName('img');

        for(var i=0; i < images.length; i++) {
            if(images[i].src.match('_off.'))
            {
                images[i].onmouseover = function() {
                    this.setAttribute('src', this.getAttribute('src').replace('_off.', '_on.'));
                }
                images[i].onmouseout = function() {
                    this.setAttribute('src', this.getAttribute('src').replace('_on.', '_off.'));
                }
            }
        }
    }
}

if(window.addEventListener) {
    window.addEventListener('load', smartRollover, false);
}
else if(window.attachEvent) {
    window.attachEvent('onload', smartRollover);
}

$(document).ready(function() {
    var pagetop = $('.pagetop');
    pagetop.click(function () {
        $('body, html').animate({ scrollTop: 0 }, 500);
        return false;
    });
    $('a img').on({
        'mouseenter':function() {
            $(this).fadeTo(200, 0.7);
        },
        'mouseleave':function() {
            $(this).fadeTo(200, 1.0);
        }
    });
  
     $('box_hover').on({
        'mouseenter':function() {
            $(this).fadeTo(200, 0.7);
        },
        'mouseleave':function() {
            $(this).fadeTo(200, 1.0);
        }
    });
    $('a.link_over').on({
        'mouseenter':function() {
            $(this).fadeTo(200, 0.7);
        },
        'mouseleave':function() {
            $(this).fadeTo(200, 1.0);
        }
    });
    //gnav 
    $('.btn_gnav').on("click", function () {
        $(this).toggleClass('opened');
        $('.head-sec_gnav').toggleClass('opened');
        $('.head-sec_gnav').slideToggle();
    });
    
    $('.btn_gnav').on('click',function(){
        $(this).find('span').toggleClass('active'); 
    });
    $('.gnav_sub').on("click", function () {
        $(this).toggleClass('opened');
        $(this).find('.m_list_sub').toggleClass('opened');
        $(this).find('.m_list_sub').slideToggle();
    });

});
$(document).ready(function () {
    $('.check_select button').click(function() {
        $(this).toggleClass('selected');
        $(this).text($(this).text() == '選択しない' ? '選択する' : '選択しない'); // <- HERE
        return false;
    });
});
//Fix height box
    equalheight = function (container) {

        var currentTallest = 0,
             currentRowStart = 0,
             rowDivs = new Array(),
             $el,
             topPosition = 0;
        $(container).each(function () {

            $el = $(this);
            $($el).height('auto')
            topPostion = $el.position().top;

            if (currentRowStart != topPostion) {
                for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                    rowDivs[currentDiv].height(currentTallest);
                }
                rowDivs.length = 0; // empty the array
                currentRowStart = topPostion;
                currentTallest = $el.height();
                rowDivs.push($el);
            } else {
                rowDivs.push($el);
                currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
            }
            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
        });
    }
    $(window).resize(function () {
        equalheight('.box_fix_height');
    });

    $(window).load(function () {
        equalheight('.box_fix_height');
    });
    $(window).resize(function () {
        equalheight('.box_fix_height01');
    });

    $(window).load(function () {
        equalheight('.box_fix_height01');
    });
 
$(function() {    
  $(".Thumbs a").click(function(){
    var changeSrc  = jQuery(this).attr("href");
    $(".targetImg").fadeOut(
      "slow",
      function() {
        $(this).attr("src",changeSrc);
        $(this).parent().attr("href",changeSrc);
        $(this).fadeIn();
      }
    );
    return false;  
  });
});  

// SCROLL TO TOP FADE EFFECT
 $(window).load(function(){
  
    $(window).scroll(function(){

    var scroll = $(window).scrollTop();

    if(scroll >= 150){
       $('.page_top').fadeIn();
    }else{
       $('.page_top').fadeOut();
     }

   });

 });
var select = '';
for (i=1;i<=999;i++){
    select += '<option val=' + i + '>' + i + '</option>';
}
$(document).ready(function() {
    var windowsize = $(window).width();

    $(window).resize(function() {
        var windowsize = $(window).width();
    });
    if (windowsize < 769) {
        $(".text_foot02").on("click",function(e){
            $(this).next().slideToggle();
            $(this).toggleClass("open");
        });
        // $(".tt_items02").on("click",function(e){
        //     $(this).next().slideToggle();
        //     $(this).toggleClass("open");
        // });
        
    }
});


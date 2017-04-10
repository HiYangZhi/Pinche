<style type="text/css">
        
    /* 本例子css */
    .slideBox{ width:100%; overflow:hidden; position:relative; border:1px solid #ddd;  }
    .slideBox .bd ul{ margin-bottom: 0; }
    .slideBox .bd{ position:relative; height:100%; z-index:0;   }
    .slideBox .bd li{ zoom:1; vertical-align:middle; overflow: hidden; display: table-cell;}
    .slideBox .bd li a{ display: block; overflow: hidden;}
    .slideBox .bd img{ width:100%; height:auto; display:block;  }

    /* 本例子css */
    .txtMarquee-left{ width:100%;  position:relative; }
    .txtMarquee-left .bd{ width: 100%; padding:10px; overflow: hidden; height: 40px;}
    .txtMarquee-left .bd .tempWrap{ width:100% !important; }/* 用 !important覆盖SuperSlide自动生成的宽度，这样就可以手动控制可视宽度。 */
    .txtMarquee-left .bd .tempWrap a{ color: #025aa5; }
    .txtMarquee-left .bd ul{ overflow:hidden; zoom:1; }
    .txtMarquee-left .bd ul li{ margin-right:20px;  float:left; height:24px; line-height:24px;  text-align:left; _display:inline; width:auto !important;  }/* 用 width:auto !important 覆盖SuperSlide自动生成的宽度，解决文字不衔接问题 */

    .txtMarquee-left .bd ul li span{ color:#999;  }
</style>
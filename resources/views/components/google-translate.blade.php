<!-- Google Translate Widget -->
<div id="gt-widget-wrapper">
    <div id="google_translate_element"></div>
</div>

<style>
    /* Floating translate button */
    #gt-widget-wrapper {
        position: fixed;
        bottom: 90px;
        left: 20px;
        z-index: 9999;
    }

    /* Hide Google Translate default bar */
    .goog-te-banner-frame, #goog-gt-tt, .goog-te-balloon-frame {
        display: none !important;
    }
    body { top: 0 !important; }
    .skiptranslate { display: none !important; }
    #google_translate_element { display: block !important; }

    /* Style the dropdown */
    #google_translate_element .goog-te-gadget {
        font-family: inherit !important;
        font-size: 0 !important;
    }

    #google_translate_element .goog-te-gadget-simple {
        background: #111 !important;
        border: 1px solid rgba(255,255,255,0.15) !important;
        border-radius: 50px !important;
        padding: 8px 16px !important;
        display: flex !important;
        align-items: center !important;
        gap: 6px !important;
        cursor: pointer !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.4) !important;
        transition: all 0.2s ease !important;
        text-decoration: none !important;
        line-height: 1 !important;
    }

    #google_translate_element .goog-te-gadget-simple:hover {
        background: #1a1a1a !important;
        border-color: rgba(255,255,255,0.25) !important;
        box-shadow: 0 6px 24px rgba(0,0,0,0.5) !important;
        transform: translateY(-1px) !important;
    }

    #google_translate_element .goog-te-gadget-simple .goog-te-menu-value {
        color: #fff !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        font-family: 'Inter', 'Poppins', system-ui, sans-serif !important;
    }

    #google_translate_element .goog-te-gadget-simple .goog-te-menu-value span {
        color: #fff !important;
        font-size: 13px !important;
    }

    #google_translate_element .goog-te-gadget-simple .goog-te-menu-value span:nth-child(3) {
        display: none !important;
    }

    #google_translate_element .goog-te-gadget-simple img {
        display: none !important;
    }

    /* Add globe icon via pseudo element */
    #google_translate_element .goog-te-gadget-simple::before {
        content: '🌐';
        font-size: 16px;
        line-height: 1;
    }

    /* Style the dropdown menu */
    .goog-te-menu2 {
        background: #111 !important;
        border: 1px solid rgba(255,255,255,0.15) !important;
        border-radius: 12px !important;
        box-shadow: 0 10px 40px rgba(0,0,0,0.6) !important;
        overflow: hidden !important;
    }

    .goog-te-menu2-item div,
    .goog-te-menu2-item:link div,
    .goog-te-menu2-item:visited div,
    .goog-te-menu2-item:active div {
        color: #fff !important;
        background: transparent !important;
        font-family: 'Inter', 'Poppins', system-ui, sans-serif !important;
        font-size: 13px !important;
        padding: 8px 16px !important;
    }

    .goog-te-menu2-item:hover div {
        background: rgba(255,255,255,0.1) !important;
    }

    .goog-te-menu2-item-selected div {
        background: rgba(160, 113, 255, 0.2) !important;
    }

    /* Mobile adjustments */
    @media (max-width: 768px) {
        #gt-widget-wrapper {
            bottom: 80px;
            left: 14px;
        }

        #google_translate_element .goog-te-gadget-simple {
            padding: 7px 12px !important;
        }

        #google_translate_element .goog-te-gadget-simple .goog-te-menu-value span:nth-child(1) {
            font-size: 12px !important;
        }
    }
</style>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,es,fr,de,it,pt,ru,zh-CN,zh-TW,ja,ko,ar,hi,tr,nl,pl,sv,da,no,fi,cs,el,he,th,vi,id,ms,tl,uk,ro,hu,bg,hr,sk,sl,sr,lt,lv,et,sw',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: false
        }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

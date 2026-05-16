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
        z-index: 99999;
    }

    /* Hide ONLY the Google Translate injected top bar */
    .goog-te-banner-frame {
        display: none !important;
    }
    body {
        top: 0 !important;
    }
    iframe.goog-te-banner-frame {
        display: none !important;
    }

    /* Style the widget container */
    #google_translate_element {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    #google_translate_element .goog-te-gadget {
        font-family: inherit !important;
        font-size: 0 !important;
        color: transparent !important;
    }

    #google_translate_element .goog-te-gadget > span {
        display: none !important;
    }

    #google_translate_element .goog-te-gadget-simple {
        background: linear-gradient(135deg, #e0f2fe, #f0f9ff, #e0f2fe) !important;
        border: 1.5px solid rgba(56, 189, 248, 0.5) !important;
        border-radius: 50px !important;
        padding: 10px 20px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        cursor: pointer !important;
        box-shadow: 0 4px 16px rgba(56, 189, 248, 0.25), 0 2px 8px rgba(0,0,0,0.1) !important;
        transition: all 0.25s ease !important;
        text-decoration: none !important;
        line-height: 1 !important;
    }

    #google_translate_element .goog-te-gadget-simple:hover {
        background: linear-gradient(135deg, #bae6fd, #e0f2fe, #bae6fd) !important;
        border-color: rgba(56, 189, 248, 0.7) !important;
        box-shadow: 0 6px 24px rgba(56, 189, 248, 0.35), 0 2px 10px rgba(0,0,0,0.15) !important;
        transform: translateY(-2px) !important;
    }

    /* Text color */
    #google_translate_element .goog-te-gadget-simple .goog-te-menu-value {
        color: #0369a1 !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        font-family: 'Inter', 'Poppins', system-ui, sans-serif !important;
    }

    #google_translate_element .goog-te-gadget-simple .goog-te-menu-value span {
        color: #0369a1 !important;
        font-size: 13px !important;
        border: none !important;
    }

    #google_translate_element .goog-te-gadget-simple .goog-te-menu-value span:nth-child(3) {
        color: #0ea5e9 !important;
    }

    #google_translate_element .goog-te-gadget-simple img {
        display: none !important;
    }

    /* Globe icon */
    #google_translate_element .goog-te-gadget-simple::before {
        content: '🌐';
        font-size: 18px;
        line-height: 1;
    }

    /* Dropdown menu styling */
    .goog-te-menu2 {
        background: #f0f9ff !important;
        border: 1.5px solid rgba(56, 189, 248, 0.3) !important;
        border-radius: 14px !important;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15), 0 0 20px rgba(56, 189, 248, 0.1) !important;
        overflow: hidden !important;
    }

    .goog-te-menu2-item div,
    .goog-te-menu2-item:link div,
    .goog-te-menu2-item:visited div,
    .goog-te-menu2-item:active div {
        color: #0c4a6e !important;
        background: transparent !important;
        font-family: 'Inter', 'Poppins', system-ui, sans-serif !important;
        font-size: 13px !important;
        padding: 10px 18px !important;
    }

    .goog-te-menu2-item:hover div {
        background: rgba(56, 189, 248, 0.15) !important;
        color: #0369a1 !important;
    }

    .goog-te-menu2-item-selected div {
        background: rgba(56, 189, 248, 0.2) !important;
        color: #0284c7 !important;
        font-weight: 700 !important;
    }

    /* Mobile adjustments */
    @media (max-width: 768px) {
        #gt-widget-wrapper {
            bottom: 24px;
            left: 14px;
        }

        #google_translate_element .goog-te-gadget-simple {
            padding: 9px 16px !important;
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
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

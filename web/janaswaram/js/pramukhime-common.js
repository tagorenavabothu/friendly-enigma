function setCookie(c_name, value, expdays) {
    var expdate = new Date();
    expdate.setDate(expdate.getDate() + expdays);
    var c_value = escape(value) + ((expdays == null) ? "" : "; expires=" + expdate.toUTCString());
    document.cookie = c_name + "=" + c_value;
}
function getCookie(c_name, defaultvalue) {
    var i, x, y, cookies = document.cookie.split(";");
    for (i = 0; i < cookies.length; i++) {
        x = cookies[i].substr(0, cookies[i].indexOf("="));
        y = cookies[i].substr(cookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == c_name) {
            return unescape(y);
        }
    }
    return defaultvalue;
}
// This functions adds option to drop down list
function addOption(elemid, text, value, selected) {
    var elem = document.getElementById(elemid);
    var newopt = document.createElement('option');
    newopt.text = text;
    newopt.value = value;
    newopt.selected = !(!selected);
    elem.add(newopt);
}

lang_divs ={
    "telugu": [{
        "top1": "రాజకీయ పార్టీ విధివిధానాల రూపకల్పన ఎవరు చేయాలి ? తలపండిన కొందరు మేధావులా....ప్రజాబాహుళ్యానికి దూరంగా బ్రతికే మరికొందరు బుద్ధిజీవులా ? కాదు , కాకూడదు .",
        "top2": "జనావాక్యమే జనసేనకు శిరోధార్యం! అందుకే జనసేన తలపెట్టింది ఓ పవిత్రకార్యం ! అదే జనస్వరం !!!!!",
        "top3": "జనస్వరం, ప్రజల కోసం ప్రజలే విధాన రూపశిల్పులుగా , మార్గనిర్దేశకులుగా అవతరించిన జనవేదిక. రండి .... జనసేన పార్టీ విధివిధానాల రూపకల్పనలో పాలుపంచుకోండి. ఇది మనకోసం మనమే రాసుకుంటున్న పవిత్రగ్రంథం.",
        "preferedlang" : "sdfds : ",
        "name" : "పేరు",
        "profession" : "వృత్తి",
        "email" : "ఈ-మెయిల్ ",
        "phoneno" : "ఫోన్ నెంబర్",
        "policyissue" : "విధి విధానాలు",
        "sugestion" : "సలహా / అభిప్రాయం / ఆలోచన ",
        "attachements" : "Attachments",
        "attachements_hint" : "Please attach supporting documents or videos"
    }],
    "hindi": [{
        "top1": "जन की बात में आपका स्वागत हैं ! जन की बात नागरिक समाज की आवाज़ हैं - यानी आपकी आवाज़ हैं !",
        "top2": "'जनस्वर' ऐसा मंच हैं जो सार्वजनिक नीति निर्माण की दिशा में आपको ले जाता हैं !",
        "top3": "यहाँ पर आपके व्यावहारिक विचार, राय और सुजाव कई मुड्ढे पर आगे बड़ कर दे सकते हैं !",
        "preferedlang" : "preferred language : ",
        "name" : "नाम",
        "profession" : "पेश",
        "email" : "ई-मेल",
        "phoneno" : "फ़ोन नंबर",
        "policyissue" : "नीति मुद्दा",
        "sugestion" : "सुजाव / राई / विचार",
        "attachements" : "Attachments ",
        "attachements_hint" : "Please attach supporting documents or videos"
    }],
    "english": [{
        "top1": "Janasena Party stands for strengthening and empowering civil society.",
        "top2": "Introducing Janaswaram, a platform for public participation in policy making.",
        "top3": "People with insightful ideas, opinions and suggestions will get a chance to participate in emerging leadership programs & policy workshops.",
        "preferedlang" : "preferred language : ",
        "name" : "Name",
        "profession" : "Profession",
        "email" : "Email",
        "phoneno" : "Phone Number",
        "policyissue" : "Phone Number",
        "sugestion" : "Suggestion/Opinion/Idea ",
        "attachements" : "Attachments ",
        "attachements_hint" : "Please attach supporting documents or videos"
    }]
}

function replacelabels(data){
    console.log(data);
    $.each(data[0],function(key,value){
            console.log(key+":"+value);
            $("."+key).text(value);
        });
}

var tips = [], currenttip = 0, turnoff = false, piresourcebase='';
// Callback function which gets called when user presses F9 key --.
function scriptChangeCallback(lang, kb, context) {

    
    //alert("check : "+lang);
   // alert(lang_divs);
    replacelabels(lang_divs[lang]);
    //console.log(lang_divs[lang]);
    
    // Change the dropdown to new selected language.
    //document.getElementById('cmdhelp').className = (lang == 'english' ? 'disabled' : '');

    var icon = pramukhIME.getIcon(4);
    // PramukhIME toolbar settings
    document.getElementById('cmdhelp').style.background = "transparent url('"+piresourcebase+"img/" + icon.iconFile + "') " + (lang == 'english' ? 100 : -1 * icon.x) + "px " + (lang == 'english' ? 100 : -1 * icon.y) + "px no-repeat";

    var i, dd = document.getElementById('drpLanguage');
    for (i = 0; i < dd.options.length; i++) {
        if (dd.options[i].value == kb + ':' + lang) {
            dd.options[i].selected = true;
        }
    }
    // Change the image
   //-- document.getElementById('pramukhimecharmap').src = piresourcebase + 'img/' + pramukhIME.getHelpImage();
    /*var filename = pramukhIME.getHelp();
    if (filename != '') {
        document.getElementById('pramukhimehelpdetailed').src = piresourcebase + 'help/' + filename;
    }
    setCookie('pramukhime_language', kb + ':' + lang, 10);*/




}
// Changing the language by selecting from dropdown list
function changeLanguage(newLanguage) {
    if (!newLanguage || newLanguage == "")
        newLanguage = 'english';
    // set new script
    var lang = newLanguage.split(':');
    pramukhIME.setLanguage(lang[1], lang[0]);
}
function showHelp(elem) {
    if (elem.className && elem.className == 'disabled') {
        return false;
    }
    showDialog('Pramukh Type Pad Help');
    document.getElementById('pramukhimehelp').style.display = 'block';
    selectHelpType();
    return false;
}
function closeDialog() {
    document.getElementById('blocker').style.display = 'none';
    document.getElementById('dialog').style.display = 'none';
    document.getElementById('typingarea').focus();
    return false;
}
function showDialog(title) {
    document.getElementById('blocker').style.display = 'block';
    document.getElementById('dialog').style.display = 'block';
    document.getElementById('dialogheader').innerHTML = title;
    document.getElementById('pramukhimehelp').style.display = 'none';
}
function selectHelpType() {
    var rdolist = document.getElementsByName('helptype');
    if (rdolist[1].checked) {
        document.getElementById('pramukhimehelpquick').style.display = 'none';
        document.getElementById('pramukhimehelpdetailed').style.display = 'block';
    } else {
        document.getElementById('pramukhimehelpquick').style.display = 'block';
        document.getElementById('pramukhimehelpdetailed').style.display = 'none';
    }
}
function showNextTip() {
    currenttip++;
    if (currenttip > tips.length) {
        currenttip = 1; // reset tip
    }
    var tipelem = document.getElementById('pi_tips'), li;
    // get first child node
    var elem, len = ul.childNodes.length, i;
    for (i = 0; i < len; i++) {
        elem = ul.childNodes[i];
        if (elem.tagName && elem.tagName.toLowerCase() == 'li') {
            li = elem;
            break;
        }
    }
    if (!turnoff && li) {
        li.innerHTML = ''; // clear
        li.appendChild(document.createTextNode('Tip ' + currenttip + ': ' + tips[currenttip - 1] + ' '));
        elem = document.createElement('a');
        elem.href = 'javascript:;';
        elem.innerHTML = 'Turn Off';
        elem.className = 'tip';
        elem.onclick = turnOffTip;
        li.appendChild(elem);
        setTimeout('showNextTip()', 10000);
    } else if (li) {
        tipelem.removeChild(li);
    }

}
function turnOffTip() {
    turnoff = true;
    showNextTip();
}

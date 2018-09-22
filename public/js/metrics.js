//======================================
//Twitter Button
//======================================


// !function (d, s, id) {
//     var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
//     if (!d.getElementById(id)) {
//         js = d.createElement(s);
//         js.id = id;
//         js.src = p + '://platform.twitter.com/widgets.js';
//         fjs.parentNode.insertBefore(js, fjs);
//     }
// }(document, 'script', 'twitter-wjs');

//======================================
//change tabs
//======================================

$('[tab-link]').click(function(){

    //change active buttons
    if($(this).hasClass('active')){return;}
    $('[tab-link]').removeClass('active');
    $(this).addClass('active');

    //clear data if it was changed
    $('#last_name, #school_name').val('');  //clear inputs
    $('.no-results').css('display','none'); //hide message IF it was shown earlier

    //show needed tab
    var link = $(this).attr('tab-link');
    $('.search-area:not('+link+')').fadeOut(300, function(){
        $('.search-area__step2, .search-area__step3').hide(0);
         setTimeout(function(){$(link).fadeIn(700);},310);

    });

});








//======================================
//Handling of "Enter" button in text-field
//======================================
$(".search-area__searchLine").on("submit", function(event){
    event.preventDefault();
    $(this).children($('.searchBtn')).trigger('click');
});





//======================================
//Opening person by link
//======================================
if ((location.hash.split('#')[1])) {
    $.ajax({
        type: "get",
        url: getPersonByShortlinkUrl,
        data: {
            searchType: 'person',
            shortlink: location.hash.split('#')[1],
            // shortlink: true
        },
        success:function(results){
            var res=results;
            var i = addPersonFoundContent(res);
            var resultHTMLblock = i[1];
            $('#personTab .search-area__rightSide').html(resultHTMLblock);
            $('.search-area__results').fadeIn(700);


            $('.twitter-share-but').addClass('twitter-share-button');
            // twttr.widgets.load();

            tooltip();
            diagramAjax(
                res.persons[0].id,
                res.persons[0].firstName,
                res.persons[0].lastName,
                res.persons[0].total,
                res.persons[0].citationsFaculty,
                res.persons[0].position,
                res.persons[0].citationsRank,
                res.chartStat['all_positions'],
                res.chartStat[res.persons[0].position]);
            saveHistory('byLink');

        }
    });
}




//======================================
//Request and showing of data
//======================================
$('.searchBtn').click(function(event) {
    event.preventDefault();
    //event.preventDefault ? event.preventDefault() : event.returnValue = false;

    var currentTab = '#'+$(this).closest('.search-area').attr('id'); //we need it that we work with data on only tab, don't touch another
    var textValue = $(currentTab+' .textfield').val(); //get search string

    //check if there is not enough symbols
    if (textValue.length<3) {
        $('.search-area__note').css({'font-size':'1.3em', 'color':'red', 'font-weight':'bold', 'text-decoration':'underline', 'margin-top':'6px'});
        return;
    } else{
        //return style if it was changed earlier
        $('.search-area__note').attr('style','');
    }


    //define, which kind of data do we need. Most of functions are united, but there are differences too
    var searchType = function(){
        if (currentTab=='#personTab'){
            return 'person';
        } else{
            return 'school'
        }
    };





    //Request to php
    $.ajax({
        type: "get",
        url: getListUrl,
        data: {
            searchType: searchType,
            textValue: textValue
        },



        beforeSend: function(result) {
            console.log(getListUrl);
            //hide everything and show "Loading" spinner
            $(currentTab+' .no-results').css('display','none');
            $(currentTab+' .search-area__results, '+currentTab+' .search-area__step2').fadeOut(200, function(){
                $(currentTab+' .search-area__loading').fadeIn(100);
            });
        },



        success:function(results){
            // var res=JSON.parse(results);
            var res=results;
            //console.log(results);


            // Two tabs have different handlings. As result, we get part of html-code for including it in DOM
            //we need 'i', that don't make function twice for getting two arrays od results
            if (currentTab=='#personTab'){
                var i = addPersonFoundContent(res);
                //if we don't have results, hide loading and show block 'no-results' instead of step2
                if (res.persons.length==0){
                    $(currentTab+' .search-area__loading').fadeOut(100, function(){
                        $(currentTab+' .no-results').fadeIn(300);
                    });
                    return;
                }

            } else{
                var i = addSchoolFoundContent(res);
                //if we don't have results, hide loading and show block 'no-results' instead of step2
                if (res.length==0){
                    $(currentTab+' .search-area__loading').fadeOut(200);
                        setTimeout(function(){
                        $(currentTab+' .no-results').fadeIn(300);
                    },300);
                    return;
                }
            }
            var filterList = i[0];
            var resultHTMLblock = i[1];







            //add results, the are hidden by styles
            $(currentTab+' .search-area__rightSide').html(resultHTMLblock);


            //hide loading and show list of results
            $(currentTab+' .search-area__loading').fadeOut(200);
            setTimeout(function(){

                $(currentTab+' .search-area__filterList').html(filterList);

                //if we have only result, we miss Step2. Just show result.
                if (res.length==1){
                    $('.search-area__results').fadeIn(700);
                    saveHistory(currentTab);
                    tooltip(); // make tooltip  for Employees of schools for Department tab.
                    return
                } else if(res['persons']!=null){                    
                    if((res.persons.length==1)) {
                        $('.search-area__results').fadeIn(700);
                        saveHistory(currentTab);



                        tooltip(); // make tooltip  for Employees of schools for Department tab.

                        $('.twitter-share-but').addClass('twitter-share-button');
                        // twttr.widgets.load();

                        diagramAjax(res.persons[0].id, res.persons[0].firstName, res.persons[0].lastName, res.persons[0].total, res.persons[0].citationsFaculty, res.persons[0].position, res.persons[0].citationsRank, res.chartStat['all_positions'], res.chartStat[res.persons[0].position]);



                        return
                    }
                }

                $(currentTab+' .search-area__step2').fadeIn(700);
                clickInList(currentTab, res); // this function will open result info for needed option
                tooltip(); // make tooltip  for Employees of schools for Department tab.
                // twttr.widgets.load();
                //console.log(res)
            },500);
            setTimeout(function(){$('.search-area__loading').hide(0);}, 500);


        }


    });

    saveHistory("search_"+currentTab, textValue);
});




//======================================
//Handling of results for searching of person. Generating HTML list of options and final results
//======================================
function addPersonFoundContent(res){
    var filterList='';
    var personInfoBlocks ='';
    for(i=0;i<res.persons.length;i++){
        filterList += '<li data-person-id="'+res.persons[i].id+'">'+res.persons[i].lastName+', '+res.persons[i].firstName+'</li>';

        personInfoBlocks +=
            '<div class="search-area__step3 search-area__results" data-person-block="'+res.persons[i].id+'">'+
                '<div class="search-area__socialButtons">';
                    if(res.persons[i].website){
                        personInfoBlocks +='<a title="Web-site" target="_blank" href="'+res.persons[i].website+'"><i class="fa fa-globe"></i></a>'
                    } else{
                        personInfoBlocks +='<i class="fa fa-globe" title="Web-site address is unavailable"></i>';
                    }
                    //if(res.persons[i].youtube){personInfoBlocks +='<a title="Youtube" target="_blank" href="'+res[i].youtube+'"><i class="fa fa-youtube-play"></i></a>'}
                    if(res.persons[i].twitter){
                        personInfoBlocks +='<a title="Twitter" target="_blank" href="'+res.persons[i].twitter+'"><i class="fa fa-twitter"></i></a>';
                    } else{
                        personInfoBlocks +='<i class="fa fa-twitter" title="Twitter profile link is unavailable"></i>';
                    }
                    if(res.persons[i].linkedIn){
                        personInfoBlocks +='<a title="LinkedIn" target="_blank" href="'+res.persons[i].linkedIn+'"><i class="fa fa-linkedin"></i></a>';
                    } else{
                        personInfoBlocks +='<i class="fa fa-linkedin" title="LinkedIn profile is unavailable"></i>';
                    }
                    //if(res[i].facebook){personInfoBlocks +='<a title="Facebook" target="_blank" href="'+res[i].facebook+'"><i class="fa fa-facebook-f"></i></a>'}
        var metricsLink = location.protocol+'//'+location.host+"/metrics";
                    console.log(metricsLink);
        var directLink = metricsLink + '/' + res.persons[i].shortlink;
        console.log(directLink);
        // var twitterLink = 'https://twitter.com/intent/tweet?original_referer=' + metricsLink + '&amp;ref_src=twsrc%5Etfw&amp;related=ScholarMetrics&amp;text=Check%20out%20my%20ScholarMetrics%20profile%20at&amp;tw_p=tweetbutton&amp;url='+ directLink + '&amp;via=ScholarMetrics';
        var twitterLink = 'https://twitter.com/intent/tweet?text=Check out my ScholarMetrics profile at&url='+ directLink + '&amp;via=ScholarMetrics';
        console.log(twitterLink);
        personInfoBlocks +=
                '</div>'+
                '<h3 class="search-area__results-title">'+res.persons[i].lastName+', '+res.persons[i].firstName+'</h3>'+
                '<span class="search-area__results-shortlink">'+directLink+'</span>'+
                '<a href="' + twitterLink + '" target="_blank" class="twitter-share-button" data-url="'+directLink+'" data-text="Check out my ScholarMetrics profile at" data-size="large"><img src="/img/twitter-share.png" alt="Tweet"></a>'+
                '<div class="search-area__results-text">'+
                    '<p><b>Position/rank: </b>'+res.persons[i].position+'</p>'+
                    '<p><b>University: </b>'+res.persons[i].university+'</p>'+
                    '<p><b>University rank: </b>'+res.persons[i].citationsDepRank+'</p>'+
                    '<p><b>Degree School: </b>'+res.persons[i].degreeSchool;
                        if (res.persons[i].degreeSchool != 'N/A'){
                            personInfoBlocks += ' ('+res.persons[i].year+')</p>';
                        } else {
                            personInfoBlocks += '</p>';
                        }
        personInfoBlocks +=
                    //'<p><b>Citations (Percentile, all faculty): </b>'+res[i].citationsFaculty+'</p>'+
                    //
                    //'<p><b>Citations (Department rank): </b>'+res[i].citationsDepRank+'</p>'+
                    '<p><b>Academic interests: </b>'+res.persons[i].academicInterests+'</p>';
                    '<hr>';
                    if(res.persons[i].googleScholar && res.persons[i].googleScholar!='x'){
                        personInfoBlocks +='<p><b>Google Scholar: </b><a title="Google Scholar" target="_blank" href="'+res.persons[i].googleScholar+'">Open profile <i class="fa fa-external-link"></i></a></p>';
                    } else{
                        personInfoBlocks +='<p><b>Google Scholar: </b> Not available</p>';
                    }
                    if(res.persons[i].researchGate && res.persons[i].researchGate!='x'){
                        personInfoBlocks +='<p><b>ResearchGate: </b><a title="ResearchGate" target="_blank" href="'+res.persons[i].researchGate+'">Open profile <i class="fa fa-external-link"></i></a></p>';
                    } else{
                        personInfoBlocks +='<p><b>ResearchGate: </b> Not available</p>';
                    }
                    /*
                    if(res.persons[i].academiaEdu && res.persons[i].academiaEdu!='x'){
                        personInfoBlocks +='<p><b>Academia.edu: </b><a title="Academia.edu" target="_blank" href="'+res.persons[i].academiaEdu+'">Open profile <i class="fa fa-external-link"></i></a></p>';
                    } else{
                        personInfoBlocks +='<p><b>Academia.edu: </b> Not available</p>';
                    }
                    */
        personInfoBlocks +=
                    '<hr>'+
                    '<div class="tooltip__container whatIsIt">'+
                        '<div data-tooltip-id="g-'+res.persons[i].id+'" class="tooltip__link">What does it mean<i class="fa fa-question-circle-o"></i></div>'+
                        '<div id="g-'+res.persons[i].id+'" style="visibility: hidden; display: none;" class="tooltip__item whatIsIt__popup">'+
                            '<p>"Citation" count is derived from Google Scholar (GS). The number indicates current estimate of how many times this scholar’s is cited in other publications indexed by GS.</p>'+
                            '<p>100% represents the highest quantity of citations by a scholar within the discipline. The percentile rank indicates the percentage of scholars with fewer GS citations.</p>'+
                            '<p>The graphs show the total number of citations on the Y-axis and percentile rank on the X-axis. The percentile shown is in comparison with all faculty as well as faculty in same position - Assistant, Associate, or (Full) Professor.</p>'+
                            //'<p>"Citations" is main measurement scale of scholar. The number shows how many times scholar was published or has been directed by another authors.</p>'+
                            //'<p>100% is maximum quantity of citations, that have the most cited scholar. All another persons are ranked proportionally depending on the amount of work.</p>'+
                            //'<p>Percent rank shows how much is the number in comparison with another scholar. Surely most of persons have few publishings and they have low rank. And only a few persons have thousands of Citations - they raise total number (100%) more.</p>'+
                            //'<p>Current graphs show, which position current scholar takes: - in comparison with all persons, and in comparison with persons of his/her position.</p>'+
                        '</div>'+
                    '</div>'+

                    '<h3 class="h3--rating">Citation ranking</h3>'+
                    '<p><b>Citations:&nbsp;</b>'+res.persons[i].total+
                    '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>H-Index:&nbsp;</b>'+res.persons[i].h_index+'</p>'+
                    '<p><b>Citation percentile ranking compared to all faculty:&nbsp;</b>';
                    if(res.persons[i].citationsFaculty != 'N/A'){
                        personInfoBlocks +=
                        '</p>' +
                        '<div class="diagram__container">'+
                            '<canvas id="chartAll-'+res.persons[i].id+'"></canvas>' +
                            '<img src="/img/loading_spinner.gif" class="diagram__loading">'+
                        '</div>';
                    } else{personInfoBlocks += res.persons[i].citationsFaculty+'</p>'}

        personInfoBlocks +=
                    '<p><b>Citation percentile ranking compared to other faculty in same position ('+res.persons[i].position+'):&nbsp;</b>';
                    if(res.persons[i].citationsRank != 'N/A'){personInfoBlocks +=
                        '</p>' +
                        '<div class="diagram__container">'+
                            '<canvas id="chartPosition-'+res.persons[i].id+'"></canvas>' +
                            '<img src="/img/loading_spinner.gif" class="diagram__loading">'+
                        '</div>';
                    } else{personInfoBlocks += res.persons[i].citationsRank+'</p>'}





                    //if (res.persons[i].websites){
                    //    var sites = res.persons[i].websites.split(',')
                    //
                    //    if (sites.length>0){
                    //        console.log(sites);
                    //        personInfoBlocks +='<p><b>Related sites and pages:</b></p><ul class="search-area__results-siteList">';
                    //        for (k=0;k<sites.length;k++){
                    //            personInfoBlocks +='<li><a target="_blank" href="'+sites[k]+'">'+sites[k]+'</a></li>'
                    //        }
                    //        personInfoBlocks +='</ul>';
                    //    }
                    //}

        personInfoBlocks +='</div>'+
            '</div>'
    }

    return [filterList, personInfoBlocks];
}







//======================================
//Handling of results for searching of Schools. Generating HTML list of options, List of Employees and info about Employees
//======================================

function addSchoolFoundContent(res){
    var filterList='';
    var schoolInfoBlocks ='';
    var tooltips='';
    for(i=0;i<res.length;i++){
        filterList += '<li data-school-id="'+res[i].id+'">'+res[i].name+'</li>';

        var emp = res[i].employee;
        var employeeList='';
        for(j=0;j<emp.length;j++){
            employeeList +=
                '<tr>' +
                    '<td class="tooltip__container">' +
                '       <a class="linkToFindPerson tooltip__link" href="#" data-tooltip-id="'+emp[j].id+'">'+emp[j].lastName+', '+emp[j].firstName+'</a>' +
                        '<div class="tooltip__item" id="'+emp[j].id+'">'+
                            '<div class="search-area__step3 search-area__employeePopup" data-person-block="'+res[i].id+'">'+
                                //'<div class="search-area__socialButtons">' +
                                //    '<a href="#"><i class="fa fa-globe"></i></a>' +
                                //    '<a href="#"><i class="fa fa-youtube-play"></i></a>' +
                                //    '<a href="#"><i class="fa fa-twitter"></i></a>' +
                                //    '<a href="#"><i class="fa fa-facebook-f"></i></a>' +
                                //'</div>'+
                                '<h3 class="search-area__results-title">'+emp[j].lastName+', '+emp[j].firstName+'</h3>'+
                                '<div class="search-area__results-text">'+
                                    '<p><b>Position/rank: </b>'+emp[j].position+'</p>'+
                                    '<p><b>University: </b>'+emp[j].university+'</p>'+
                                    '<p><b>Degree School: </b>'+emp[j].degreeSchool;
                                        if (emp[j].degreeSchool != 'N/A'){
                                            employeeList += ' ('+emp[j].year+')</p>';
                                        } else {
                                            employeeList += '</p>';
                                        }
            employeeList +=
                                    '<p><b>Citations (Percentile, all faculty): </b>'+emp[j].citationsFaculty+'%</p>'+
                                    '<p><b>Citations (Percentile, at rank): </b>'+emp[j].citationsRank+'%</p>'+
                                    '<p><b>Citations (Department rank): </b>'+emp[j].citationsDepRank+'</p>'+
                                    '<p><b>Academic interests: </b>'+emp[j].academicInterests+'</p>'+
                                '</div>'+
                            '</div>'+
                        '<div>'+
                    '</td>' +
                    '<td>'+emp[j].position+'</td>' +
                    '<td>'+emp[j].cites+'</td>' +
                '</tr>';
        }



        schoolInfoBlocks +=
            '<div class="search-area__step3 search-area__results" data-school-block="'+res[i].id+'">'+
            '<h3 class="search-area__results-title">'+res[i].name+'</h3>'+
            '<p class="search-area__results-rank"><b>Rank: </b>'+res[i].rank+'</p>';
            if(res[i].website){schoolInfoBlocks +='<p class="search-area__results-rank"><b>Website: </b> <a href="'+res[i].website+'">'+res[i].website+'</a></p>'}
        schoolInfoBlocks +=
        '<table class="search-area__universityEmployees">'+
                    '<thead>'+
                        '<tr>'+
                            '<td>Name</td>'+
                            '<td>Position</td>'+
                            '<td>Citations as of '+contentYear+'</td>'+
                        '</tr>'+
                    '</thead>'+
                    '<tbody>'+
                        employeeList+
                    '</tbody>'+
                '</table>'+
            '</div>'


    }


    return [filterList, schoolInfoBlocks, tooltips];
}







//======================================
//Opening of Results
//======================================

function clickInList(currentTab, res) {
    // console.log('HELLo!');
    //we need it for unmixing existing results from another page



    if (currentTab == '#personTab'){
        var dataAttribute='data-person';
    } else{
        var dataAttribute='data-school';

    }

    $('.search-area__filterList li').click(function () {
        $('.search-area__filterList li').removeClass('active');
        $(this).addClass('active');


        var currentTab = '#' + $(this).closest('.search-area').attr('id');
        var neededBlock = $(this).attr(dataAttribute+'-id');
        console.log(currentTab);



        $(currentTab + ' .search-area__results').fadeOut(200);
        setTimeout(function(){
            $(currentTab + ' .search-area__results').css('opacity', '0');
            $('['+dataAttribute+'-block='+neededBlock+']').fadeIn(0, function () {
                resultsEqualHeight();
                $('['+dataAttribute+'-block='+neededBlock+']').animate({opacity: 1}, 400)
            });


            // save search_history
            saveHistory(currentTab);



        },300);

        if (currentTab == '#personTab') {

            //var cur;
            for (i=0;i<res.persons.length;i++){
                 if (res.persons[i].id == neededBlock){
                    //cur = i;

                     $('[data-person-block='+neededBlock+'] .twitter-share-but').addClass('twitter-share-button');
                     // twttr.widgets.load();
                     setTimeout(function(){


                     },200);
                     diagramAjax(res.persons[i].id, res.persons[i].firstName, res.persons[i].lastName, res.persons[i].total, res.persons[i].citationsFaculty, res.persons[i].position, res.persons[i].citationsRank, res.chartStat['all_positions'], res.chartStat[res.persons[i].position]);

                 }
            }

        }
        // $(".btn-o").css({'width':'75px'});


    });





}


//======================================
//Save history of clicking
//======================================
function saveHistory(currentTab, textValue) {

    if (textValue==null){
        textValue = $('.search-area__results:visible > .search-area__results-title').text()
    }

    $.ajax({
        type: "get",
        url: "/saveHistory",
        data: {
            name: textValue,
            type: currentTab
        }
    });
}




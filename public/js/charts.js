var chart_request ='';
function diagramAjax(index, firstName, lastName, total, commonPercent, personPost, postPercent, commonData, postData){
    // console.log('hello!!!');
    if (commonPercent == 'N/A' && postPercent == 'N/A'){
        return
    }

    if (void 0 != $('#chartAll-'+index).attr('width')){
        return
    }
    if (chart_request) {
        chart_request.abort();
    }

    var cmData = [];
    var pData = [];

    $.each(commonData, function(index, value) { cmData.push(value); });
    $.each(postData, function(index, value) { pData.push(value); });



    // console.log(cmData);
    buildDiagram(cmData, 'common', 'chartAll-'+index, firstName, lastName, total, commonPercent);
    buildDiagram(pData, 'post', 'chartPosition-'+index, firstName, lastName, total, postPercent);




}








function buildDiagram(res, diagramType, blockId, firstName, secondName, total, percent){

    // console.log(blockId);
    var res2=[];
    $.each(res, function(index, value){
        //$(res2).toArray(value+0);
        res2.push(parseInt(value));
    });

    res2.sort(function(a,b){return a - b});

    // console.log(res2);

    if (percent == 'N/A'){return;}


    var ctx = $("#"+blockId);


    var mainPointData = [];
    for (i=0;i<=100;i++){
        if (i==percent){
            mainPointData.push(total);
        } else{
            mainPointData.push(null);
        }
    }



    Chart.defaults.global.legend.display = false;
    //Chart.defaults.global.legend.labels.generateLabels= function(data) {
    //    console.log(data);
    //}

    var myChart = new Chart(ctx, {

        type: 'line',
        data: {
            // scaleLabel: {
            //     display: true,
            //     labelString: 'hello',
            // },
            // labels: ['0%', '','','','','','','','','',  '10%', '','','','','','','','','',  '20%', '','','','','','','','','',                '30%', '','','','','','','','','',                '40%', '','','','','','','','','',                '50%', '','','','','','','','','',                '60%', '','','','','','','','','',                '70%', '','','','','','','','','',                '80%', '','','','','','','','','',                '90%', '','','','','','','','','',                '100%'],
            labels: ['0%', '','','','','','','','','',  '10%', '','','','','','','','','',  '20%', '','','','','','','','','',                '30%', '','','','','','','','','',                '40%', '','','','','','','','','',                '50%', '','','','','','','','','',                '60%', '','','','','','','','','',                '70%', '','','','','','','','','',                '80%', '','','','','','','','','',                '90%', '','','','','','','','','',                '100%'],
            datasets: [
                {
                    label: (firstName+' '+secondName+' ('+percent+'%)'),
                    data: mainPointData,
                    pointRadius: 5,
                    borderWidth: 2,
                    pointBackgroundColor: "#E85A1D",
                    borderColor: "#E85A1D",
                    backgroundColor: "#E85A1D"
                },
                {
                    label: 'Other faculty',
                    data: res2,
                    pointRadius: 0,
                    borderWidth: 3,
                    borderColor: "#888"
                }]
        },
        options: {
            scales: {
                xAxes:[{

                }],
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        userCallback: function(value, index, values) {
                            return addCommas(value);
                        }
                    }
                }]
            }

        }
    });

    $("#"+blockId).before('<div class="diagram__legend">' +
        '<p><span style="color: #E85A1D">&bull;</span> '+firstName+' '+secondName+' ('+percent+'%)'+'</p>' +
        '<p><span class="diagram__legend-line" style="color: #888">&mdash;</span> Other faculty</p>' +
        '</div>');

}
function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
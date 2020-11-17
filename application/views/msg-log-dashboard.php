<style>
#chartdiv {
  width: 100%;
  height: 300px;
}
#chartdiv2 {
  width: 100%;
  height: 300px;
}

#chartdiv1 {
  width: 100%;
  height: 500px;
}
    .highcharts-figure, .highcharts-data-table table {
    min-width: 100%; 
    max-width: 800px;
    margin: 1em auto;
}
#chartdiv6 {
  width: 100%;
  height: 500px;
}
.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>
<div class="row">
    <div style="float:right;"><a class="btn btn-primary" href="<?= base_url('dashboard/support_dash') ?>">Switch to Sales Dashboard</a></div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!-- // datewise ticket for msg -->
<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
       
    </p>
</figure>
<figure class="highcharts-figure">
    <div id="container2"></div>
    </p>
</figure>
<figure class="highcharts-figure">
    <div id="container3"></div>
    </p>
</figure>
<script>
    Highcharts.getJSON(
    '<?=base_url('dashboard/datewiseSupportData/1/0')?>',
    function (data) {

        Highcharts.chart('container', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'Total Email Datewise'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
            },
            xAxis: {
                type: 'datetime',
                labels: {
        formatter: function() {
          return Highcharts.dateFormat('%b/%e/%Y', this.value);
        }
            }
            },
            yAxis: {
                title: {
                    text: 'Ticket Generation rate'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'Number of Tickets',
                data: data
            }]
        });
    }
);
</script>

<script>
    Highcharts.getJSON(
    '<?=base_url('dashboard/datewiseSupportData/1/1')?>',
    function (data) {

        Highcharts.chart('container2', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'Total SMS Datewise'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
            },
            xAxis: {
                type: 'datetime',
                labels: {
        formatter: function() {
          return Highcharts.dateFormat('%b/%e/%Y', this.value);
        }
            }
            },
            yAxis: {
                title: {
                    text: 'Ticket Generation rate'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[4]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[4]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'Number of Tickets',
                data: data
            }]
        });
    }
);
</script>

<script>
    Highcharts.getJSON(
    '<?=base_url('dashboard/datewiseSupportData/1/2')?>',
    function (data) {

        Highcharts.chart('container3', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'Total Whatsapp Datewise'

            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
            },
            xAxis: {
                type: 'datetime',
                labels: {
        formatter: function() {
          return Highcharts.dateFormat('%b/%e/%Y', this.value);
        }
            }
            },
            yAxis: {
                title: {
                    text: 'Ticket Generation rate'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[8]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[8]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'Number of Tickets',
                data: data
            }]
        });
    }
);
</script>
<hr>
<br>
<br>

<center><h3>Userwise Graph's</h3></center>
<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}

</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
          $(document).ready(function(){
    $.ajax({
      url : "<?=base_url('dashboard/userWiseSupportData')?>",
      type: "post",
      dataType : "json",
      processData: false,
      contentType: false,
      success : function(response)
      {
        am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv", am4charts.XYChart);

// some extra padding for range labels
chart.paddingBottom = 50;

chart.cursor = new am4charts.XYCursor();
chart.scrollbarX = new am4core.Scrollbar();

// will use this to store colors of the same items
var colors = {};

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
categoryAxis.renderer.minGridDistance = 60;
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.dataItems.template.text = "{realName}";
categoryAxis.adapter.add("tooltipText", function(tooltipText, target){
  return categoryAxis.tooltipDataItem.dataContext.realName;
})

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.tooltip.disabled = true;
valueAxis.min = 0;

// single column series for all data
var columnSeries = chart.series.push(new am4charts.ColumnSeries());
columnSeries.columns.template.width = am4core.percent(80);
columnSeries.tooltipText = "{provider}: {realName}, {valueY}";
columnSeries.dataFields.categoryX = "category";
columnSeries.dataFields.valueY = "value";

// second value axis for quantity
var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis2.renderer.opposite = true;
valueAxis2.syncWithAxis = valueAxis;
valueAxis2.tooltip.disabled = true;

// quantity line series
var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.tooltipText = "{valueY}";
lineSeries.dataFields.categoryX = "category";
lineSeries.dataFields.valueY = "quantity";
lineSeries.yAxis = valueAxis2;
lineSeries.bullets.push(new am4charts.CircleBullet());
lineSeries.stroke = chart.colors.getIndex(13);
lineSeries.fill = lineSeries.stroke;
lineSeries.strokeWidth = 2;
lineSeries.snapTooltip = true;

// when data validated, adjust location of data item based on count
lineSeries.events.on("datavalidated", function(){
 lineSeries.dataItems.each(function(dataItem){
   // if count divides by two, location is 0 (on the grid)
   if(dataItem.dataContext.count / 2 == Math.round(dataItem.dataContext.count / 2)){
   dataItem.setLocation("categoryX", 0);
   }
   // otherwise location is 0.5 (middle)
   else{
    dataItem.setLocation("categoryX", 0.5);
   }
 })
})

// fill adapter, here we save color value to colors object so that each time the item has the same name, the same color is used
columnSeries.columns.template.adapter.add("fill", function(fill, target) {
 var name = target.dataItem.dataContext.realName;
 if (!colors[name]) {
   colors[name] = chart.colors.next();
 }
 target.stroke = colors[name];
 return colors[name];
})


var rangeTemplate = categoryAxis.axisRanges.template;
rangeTemplate.tick.disabled = false;
rangeTemplate.tick.location = 0;
rangeTemplate.tick.strokeOpacity = 0.6;
rangeTemplate.tick.length = 60;
rangeTemplate.grid.strokeOpacity = 0.5;
rangeTemplate.label.tooltip = new am4core.Tooltip();
rangeTemplate.label.tooltip.dy = -10;
rangeTemplate.label.cloneTooltip = false;

///// DATA
var chartData = [];
var lineSeriesData = [];

var data =response;

// process data ant prepare it for the chart
for (var providerName in data) {
 var providerData = data[providerName];

 // add data of one provider to temp array
 var tempArray = [];
 var count = 0;
 // add items
 for (var itemName in providerData) {
   if(itemName != "quantity"){
   count++;
   // we generate unique category for each column (providerName + "_" + itemName) and store realName
   tempArray.push({ category: providerName + "_" + itemName, realName: itemName, value: providerData[itemName], provider: providerName})
   }
 }
 // sort temp array
 tempArray.sort(function(a, b) {
   if (a.value > b.value) {
   return 1;
   }
   else if (a.value < b.value) {
   return -1
   }
   else {
   return 0;
   }
 })

 // add quantity and count to middle data item (line series uses it)
 var lineSeriesDataIndex = Math.floor(count / 2);
 tempArray[lineSeriesDataIndex].quantity = providerData.quantity;
 tempArray[lineSeriesDataIndex].count = count;
 // push to the final data
 am4core.array.each(tempArray, function(item) {
   chartData.push(item);
 })

 // create range (the additional label at the bottom)
 var range = categoryAxis.axisRanges.create();
 range.category = tempArray[0].category;
 range.endCategory = tempArray[tempArray.length - 1].category;
 range.label.text = tempArray[0].provider;
 range.label.dy = 30;
 range.label.truncate = true;
 range.label.fontWeight = "bold";
 range.label.tooltipText = tempArray[0].provider;

 range.label.adapter.add("maxWidth", function(maxWidth, target){
   var range = target.dataItem;
   var startPosition = categoryAxis.categoryToPosition(range.category, 0);
   var endPosition = categoryAxis.categoryToPosition(range.endCategory, 1);
   var startX = categoryAxis.positionToCoordinate(startPosition);
   var endX = categoryAxis.positionToCoordinate(endPosition);
   return endX - startX;
 })
}

chart.data = chartData;


// last tick
var range = categoryAxis.axisRanges.create();
range.category = chart.data[chart.data.length - 1].category;
range.label.disabled = true;
range.tick.location = 1;
range.grid.location = 1;

}); // end am4core.ready()
      }
});
    
});
</script>
<br>
<br>

<!-- HTML -->
<div id="chartdiv"></div>
<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>


<!-- Chart code -->
<script>
          $(document).ready(function(){
    $.ajax({
      url : "<?=base_url('dashboard/userWiseSupportData1')?>",
      type: "post",
      dataType : "json",
      processData: false,
      contentType: false,
      success : function(response)
      {

            am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv23", am4charts.XYChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.data = response;
// alert(response);
chart.colors.step = 2;
chart.padding(30, 30, 10, 30);
chart.legend = new am4charts.Legend();

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
categoryAxis.renderer.grid.template.location = 0;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.min = 0;
valueAxis.max = 100;
valueAxis.strictMinMax = true;
valueAxis.calculateTotals = true;
valueAxis.renderer.minWidth = 50;


var series1 = chart.series.push(new am4charts.ColumnSeries());
series1.columns.template.width = am4core.percent(80);
series1.columns.template.tooltipText =
  "{name}: {valueY.totalPercent.formatNumber('#.00')}%";
series1.name = "Email";
series1.dataFields.categoryX = "category";
series1.dataFields.valueY = "value1";
series1.dataFields.valueYShow = "totalPercent";
series1.dataItems.template.locations.categoryX = 0.5;
series1.stacked = true;
series1.tooltip.pointerOrientation = "vertical";

var bullet1 = series1.bullets.push(new am4charts.LabelBullet());
bullet1.interactionsEnabled = false;
bullet1.label.text = "{valueY.totalPercent.formatNumber('#.00')}%";
bullet1.label.fill = am4core.color("#ffffff");
bullet1.locationY = 0.5;

var series2 = chart.series.push(new am4charts.ColumnSeries());
series2.columns.template.width = am4core.percent(80);
series2.columns.template.tooltipText =
  "{name}: {valueY.totalPercent.formatNumber('#.00')}%";
series2.name = "SMS";
series2.dataFields.categoryX = "category";
series2.dataFields.valueY = "value2";
series2.dataFields.valueYShow = "totalPercent";
series2.dataItems.template.locations.categoryX = 0.5;
series2.stacked = true;
series2.tooltip.pointerOrientation = "vertical";

var bullet2 = series2.bullets.push(new am4charts.LabelBullet());
bullet2.interactionsEnabled = false;
bullet2.label.text = "{valueY.totalPercent.formatNumber('#.00')}%";
bullet2.locationY = 0.5;
bullet2.label.fill = am4core.color("#ffffff");

var series3 = chart.series.push(new am4charts.ColumnSeries());
series3.columns.template.width = am4core.percent(80);
series3.columns.template.tooltipText =
  "{name}: {valueY.totalPercent.formatNumber('#.00')}%";
series3.name = "Whatsapp";
series3.dataFields.categoryX = "category";
series3.dataFields.valueY = "value3";
series3.dataFields.valueYShow = "totalPercent";
series3.dataItems.template.locations.categoryX = 0.5;
series3.stacked = true;
series3.tooltip.pointerOrientation = "vertical";

var bullet3 = series3.bullets.push(new am4charts.LabelBullet());
bullet3.interactionsEnabled = false;
bullet3.label.text = "{valueY.totalPercent.formatNumber('#.00')}%";
bullet3.locationY = 0.5;
bullet3.label.fill = am4core.color("#ffffff");
chart.scrollbarX = new am4core.Scrollbar();
}); // end am4core.ready()
      }
});
    
});
</script>
<!-- HTML -->
<div id="chartdiv23"></div>
<!-- Styles -->
<style>
#chartdiv23 {
  width: 100%;
  height: 500px;
}
</style>
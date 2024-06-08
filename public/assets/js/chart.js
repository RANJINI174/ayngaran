(()=>{function e(e,a,o){
    return a in e?Object.defineProperty(e,a,{
        value:o,enumerable:!0,configurable:!0,writable:!0
        
    }):e[a]=o,e}$((function(){
        "use strict";var a,o,r,t=document.getElementById("chartLine").getContext("2d"),
        n=(new Chart(t,{type:"line",data:{labels:["Sun","Mon","Tus","Wed","Thu","Fri","Sat"],
        datasets:[(a={label:"Profits",data:[100,420,210,420,210,320,350],
        borderWidth:2,
        backgroundColor:"transparent",borderColor:"#6259ca"},
        e(a,"borderWidth",3),e(a,"pointBackgroundColor","#ffffff")
        ,e(a,"pointRadius",2),a),(o={label:"Expenses",data:[450,200,350,250,480,200,400]
        ,borderWidth:2,
        backgroundColor:"transparent",
        borderColor:"#eb6f33"},e(o,"borderWidth",3),e(o,"pointBackgroundColor","#ffffff"),e(o,"pointRadius",2),o)]},
        options:{
            responsive:!0,maintainAspectRatio:!1,
            scales:{
                xAxes:[{ticks:{fontColor:"#77778e"},display:!0,
                gridLines:{color:"rgba(119, 119, 142, 0.2)"}
                    
                }],
                yAxes:[{
                    ticks:{fontColor:"#77778e"},display:!0,
                    gridLines:{color:"rgba(119, 119, 142, 0.2)"},
                    scaleLabel:{display:!1,labelString:"Thousands",fontColor:"rgba(119, 119, 142, 0.2)"}
                    
                }
                ]},
                legend:{
                    labels:{
                        fontColor:"#77778e"}
                    
                }
            
        }}),
        t=document.getElementById("chartBar1").getContext("2d"),
        new Chart(t,{type:"bar",
        data:{labels:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep"],
        datasets:[(r={label:"Sales",data:[200,450,290,367,256,543,345,290,367],
        borderWidth:2,backgroundColor:"#6259ca",borderColor:"#6259ca"},
        e(r,"borderWidth",2),e(r,"pointBackgroundColor","#ffffff"),r)]},
        options:e({responsive:!0,maintainAspectRatio:!1,
        legend:{display:!0},
        scales:{yAxes:[{ticks:{beginAtZero:!0,stepSize:150,fontColor:"#77778e"},
        gridLines:{color:"rgba(119, 119, 142, 0.2)"}}],
        xAxes:[{ticks:{display:!0,fontColor:"#77778e"},
        gridLines:{display:!1,color:"rgba(119, 119, 142, 0.2)"}}]}},
        "legend",{labels:{fontColor:"#77778e"}})}),
        t=document.getElementById("chartBar2"),
        new Chart(t,{type:"bar",data:{labels:["Jan","Feb","Mar","Apr","May","Jun","Jul"],
        datasets:[{label:"Data1",data:[65,59,80,81,56,55,40],borderColor:"#6259ca",borderWidth:"0",backgroundColor:"#6259ca"}
        ,{label:"Data2",data:[28,48,40,19,86,27,90],borderColor:"#eb6f33",borderWidth:"0",backgroundColor:"#eb6f33"}]},
        options:{responsive:!0,maintainAspectRatio:!1,scales:{xAxes:[{ticks:{fontColor:"#77778e"}
        ,gridLines:{color:"rgba(119, 119, 142, 0.2)"}}],
        yAxes:[{ticks:{beginAtZero:!0,fontColor:"#77778e"},
        gridLines:{color:"rgba(119, 119, 142, 0.2)"}}]},
         
        legend:{
            labels:{fontColor:"#77778e"}}}}),
            t=document.getElementById("chartArea"),
            
           new Chart(t,{type:"line",
        data:{
           
            labels:["Jan","Feb","Mar","Apr","May","Jun","Jul"],
            datasets:[
                {
                    label:"Data2",
                    borderColor:"rgba(235, 111, 51 ,0.9)",
                    borderWidth:"3",
                    backgroundColor:"rgba(\t235, 111, 51, 0.7)",
        pointHighlightStroke:"rgba(235, 111, 51 ,1)",data:[16,32,18,26,42,33,44]},
        {
            label:"Data1",
            borderColor:"#6259ca",
            borderWidth:"3", 
            backgroundColor:"#5e2dd81a",
            data:[22,44,67,43,76,45,12]}]},
            options:{
                responsive:!0,
                maintainAspectRatio:!1,
                tooltips:{mode:"index",intersect:!1},
                hover:{mode:"nearest",intersect:!0},
                scales:{xAxes:[{ticks:{fontColor:"#77778e"},
                gridLines:{color:"rgba(119, 119, 142, 0.2)"}
                    
                }],
                yAxes:[{
                    ticks:{
                        beginAtZero:!0,
                        fontColor:"#77778e"
                        
                    },
                    gridLines:{
                        color:"rgba(119, 119, 142, 0.2)"}
                    
                }]},
                legend:{
                    labels:{fontColor:"#77778e"}
                    
                }}}),
                {
                    labels:["Jan","Feb","Mar","Apr","May"],
                    datasets:[{data:[20,20,30,5,25],
                    backgroundColor:["#6259ca","#eb6f33","#ec546c","#0774f8","#9857CD"]}
                    ]}),
                    l={
                        maintainAspectRatio:!1,
                    responsive:!0,
                    legend:{display:!1},
                    animation:{animateScale:!0,animateRotate:!0}
                        
                    },
                    i=document.getElementById("chartPie"),
                    d=(new Chart(i,{type:"doughnut",data:n,options:l}),
                    document.getElementById("chartDonut"));
                    new Chart(d,{type:"pie",data:n,options:l}),
                    t=document.getElementById("chartRadar"),
                    new Chart(t,{type:"radar",
                    data:{
                        labels:[["Eating","Dinner"]
                        ,["Drinking","Water"],"Sleeping",["Designing","Graphics"],"Coding","Cycling","Running"],
                    datasets:[{label:"Data1",data:[65,59,66,45,56,55,40],borderColor:"rgba(113, 76, 190, 0.9)",borderWidth:"1",backgroundColor:"rgba(113, 76, 190, 0.5)"},
                    {label:"Data2",data:[28,12,40,19,63,27,87],borderColor:"rgba(235, 111, 51,0.8)",borderWidth:"1",backgroundColor:"rgba(235, 111, 51,0.4)"}]},
                    options:{responsive:!0,maintainAspectRatio:!1,legend:{display:!1},scale:{angleLines:{color:"#77778e"},gridLines:{color:"rgba(119, 119, 142, 0.2)"},
                    ticks:{beginAtZero:!0},pointLabels:{fontColor:"#77778e"}}}}),t=document.getElementById("chartPolar"),new Chart(t,{type:"polarArea",
                    data:{datasets:[{data:[18,15,9,6,19],backgroundColor:["#6259ca","#9959CA","#ec546c","#0774f8","#CA59C0"],
                    hoverBackgroundColor:["#6259ca","#9959CA","#09ad95","#0774f8","#CA59C0"],borderColor:"transparent"}],labels:["Data1","Data2","Data3","Data4"]},
                    options:{scale:{gridLines:{color:"rgba(119, 119, 142, 0.2)"}},responsive:!0,maintainAspectRatio:!1,legend:{labels:{fontColor:"#77778e"}}}})}))})();
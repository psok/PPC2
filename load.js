function initialize() {
  var mapOptions = {
    zoom: 11,
    center: new google.maps.LatLng(41.87690644193034, -87.61910126708983)
  };

  var map = new google.maps.Map(document.getElementById('googft-mapCanvas'),
      mapOptions);


    var layer = new google.maps.FusionTablesLayer({
      map: map,
      heatmap: { enabled: false },
      query: {
        select: "*",
        from: "17CMiNfHRvDsHfoWfg-eiseLBriG_a1uaxwQo7p5n",
        		},    		
    		styles: [{
			where: "Author ENDS WITH 'Brooks'",
    			markerOptions: {
 			iconName: "large_red"
    			}
    			}, {
    			where: "Author ENDS WITH 'Sandburg'",
    			markerOptions: {
    				iconName: "large_blue"
    				}
				}, {
         where: "Author ENDS WITH 'Piercy'",
         markerOptions: {
          iconName: "large_green"
            }
        }, {
          where: "Author ENDS WITH 'Cardenas'",
          markerOptions: {
            iconName: "large_yellow"
          }
        }, {
          where: "Author ENDS WITH 'Davis'",
          markerOptions: {
            iconName: "large_purple"
          }
        }, {
            where: "Author ENDS WITH 'Welch'",
          markerOptions: {
             iconName: "large_red"
            }
          }, {
          where: "Author ENDS WITH 'Williams'",
          markerOptions: {
            iconName: "Itblue_cicle"
            }
        }, {
         where: "Author ENDS WITH 'Boruch'",
         markerOptions: {
          iconName: "wht_circle"
            }
        }]   
    	}); 

   

  /*var legend = document.getElementById('legend');
        var name = query.styles.where;
	var icon = query.styles.markerOptions.iconName; 
          div.innerHTML = '<img src="' + icon + '"> ' + name;
          legend.appendChild(div);

*/
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(document.getElementById('MapLegend'));
}

function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +
      'callback=initialize';
  document.body.appendChild(script);
}

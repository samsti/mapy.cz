var m = new SMap(JAK.gel("m"), SMap.Coords.fromWGS84(14.400307, 50.071853));
m.addControl(new SMap.Control.Sync()); /* Aby mapa reagovala na změnu velikosti průhledu */
m.addDefaultLayer(SMap.DEF_BASE).enable();
var mouse = new SMap.Control.Mouse(SMap.MOUSE_PAN | SMap.MOUSE_WHEEL | SMap.MOUSE_ZOOM); /* Ovládání myší */
m.addControl(mouse);

function click(e, elm) { /* Došlo ke kliknutí, spočítáme kde */
    var souradnice = SMap.Coords.fromEvent(e.data.event, m);
    var input = document.getElementById("souradnice");
    input.value = souradnice.toWGS84(2).reverse().join(" ");
}
m.getSignals().addListener(window, "map-click", click); /* Při signálu kliknutí volat tuto funkci */

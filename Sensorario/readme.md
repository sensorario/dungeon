# sensorario/dungeon

Questa è una libreria php per la creazione di dungeon a base esagonale.

## Classes

    Sensorario\Dungeon\Map       - una mappa che si può estendere senza limiti
    Sensorario\Dungeon\LittleMap - una piccola mappa di 19 tiles

## LittleMap

             / \ / \ / \
            |   |   |   |
           / \ / \ / \ / \
          |   |   |   |   |
         / \ / \ / \ / \ / \
        |   |   |   |   |   |
         \ / \ / \ / \ / \ /
          |   |   |   |   |
           \ / \ / \ / \ /
            |   |   |   |
             \ / \ / \ /

## Utilizzo

Per creare una cella, basta istanziare la classe Tile indicando le coordinate di partenza.

    $tile = new Tile(0, 0); // 0, 0

Ci si può spostare di tile in tile usando le sei direzioni disponibili:

    Directions::DOWN_RIGHT
    Directions::DOWN_LEFT
    Directions::LEFT
    Directions::LEFT_UP
    Directions::RIGHT_UP
    Directions::RIGHT

La libreria fornisce una classe che genera automaticamente un piccolo dungeon. Verranno generate tile fino ad una distanza di due tile dalla centrale.

    $map = new LittleMap();

C'è anche una classe Map che istanziata funziona esattamente come LittleMap(). La differenza è che alla Map possono essere aggiunte Tile a piacimento. Inoltre, è anche possibile far crescere la mappa partendo da una delle celle di confine. Attorno a questa cella, fino a due tile di distanza, verranno generate le nuote tile.

    $center = new Tile(0, 0);
    $map = new Map($center, 2);
    $map->addTile(new Tile(2, 1), 1);

La classe forse più importante è la classe World.

    $world = new World('dungeon');
    $world->growAroundTile($world->getEdgeTile());

Questa classe fornisce un metodo World::growAroundTile(Tile $tile); che fa crescere la mappa in maniera casuale. Un altro metodo importante, è World::getEdgeTile() che restituisce una Tile casuale, tra quelle presenti nei confini della mappa generata sino a questo momento.

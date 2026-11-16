1. Le background qui recharge a chaque navigation d'onglet 
    - Why : Le fond n’était pas charge en cache et google repaint le site a chaque navigation car c'est par des routes
    - How : Précharger le fond dans le `<head>` : 
    ```html
    <link rel="preload" as="image" href="{{ asset('css/background.jpg') }}" fetchpriority="high">
    ```
2. Déployer le site
    - Why : On a un mélange de technologie : php et Laravel. Le site sur lequel on est habitué a déployer nos site ne fait pas de déploiement de site dynamique.
    - Render permet de deployer des site comme le notre via Docker. On a donc crée le fichier <a href="Dockerfile">Dockerfile</a> pour deployer via Render 
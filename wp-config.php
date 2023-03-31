<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'contact_form_plugin' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ']vW!L-]_u/TQ4yj,0,o,/m@uG8@>ST>R6@c6]_GDo|$b_^YSO|ivz*bh@mG/z0n9' );
define( 'SECURE_AUTH_KEY',  'l?Z;7~{v.*cm.TxPWi#+pHXi{l|uO:>%O GkUuAR,Q0I^%iq Ci1#L^U0yG&JfwX' );
define( 'LOGGED_IN_KEY',    'ZG.pO&<&7btqALiZ}H|EmB%+!v^5;|2Uxm^MwVOa_&fLt=|sKqM%`~TBUDR:BKM)' );
define( 'NONCE_KEY',        'OH/kFf>P26X-|ZI:&`!R9U!(=.%9b~0rh39ow/x8EGksXX&9xxvtH;Dk@%1V<o%*' );
define( 'AUTH_SALT',        '+/Y!SO^^ -agt)<Du!@lQ=`s/Q;Kt=c56xB(vH!]A #7A?lpw`:,%4rev</-<TYf' );
define( 'SECURE_AUTH_SALT', 'T2X>R@fjG1#@y_WjML7.lYlC/=V+0oKWIgEus6ErOYH2&MDzss`zNS_;B:gr4575' );
define( 'LOGGED_IN_SALT',   '0~a{zfE,MKqyj*|HbsK6ESJv96kz8q*ngZ *NN>,YmHie5n%hjz{dCJc|<~wGjtl' );
define( 'NONCE_SALT',       'VtDiz12Tm.Ky/[&4]kOuDCWr(fhx#= /_^><0?3J),`wgs`vEvMq})rSUJ>^8*`1' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );

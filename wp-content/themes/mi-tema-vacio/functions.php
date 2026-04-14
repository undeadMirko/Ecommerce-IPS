<?php
/**
 * Custom Post Type: "Casos de Exito"
 */

function create_casos_exito_cpt() { #Función para crear el Custom Post Type "Casos de Exito"
    $labels = array(     # Se crea la variable $labels con un array (Lista) de etiquetas para el Custom Post Type
        'name' => 'Casos de Exito', # Nombre general del post-type
        'singular_name' => 'Caso de Exito', # Nombre singular del post-type
        'menu_name' => 'Casos de Exito', # Nombre del menú en el admin
        'name_admin_bar' => 'Caso de Exito', # Nombre en la barra de administración
        'add_new' => 'Agregar Nuevo', # Texto para el botón "Agregar Nuevo"
        'add_new_item' => 'Agregar Nuevo Caso de Exito', # Texto para el formulario de agregar nuevo
        'new_item' => 'Nuevo Caso de Exito', # Texto para el nuevo ítem
        'edit_item' => 'Editar Caso de Exito', # Texto para el formulario de edición
        'view_item' => 'Ver Caso de Exito', # Texto para el enlace de ver ítem
        'all_items' => 'Todos los Casos de Exito', # Texto para el enlace de todos los ítems
        'search_items' => 'Buscar Casos de Exito',   # Texto para el formulario de búsqueda
        'not_found' => 'No se encontraron casos de exito.', # Texto cuando no se encuentran ítems
        'not_found_in_trash' => 'No se encontraron casos de exito en la papelera.' # Texto cuando no se encuentran ítems en la papelera
    );  

    $args = array( # args es la variable que es el manual de instrucciones que (contiene un array (Lista) de argumentos) para el Custom Post Type 
        'labels' => $labels, # Usa las etiquetas de nombres que definimos en $labels
        'thumbnail' => true, # Soporte para imagen destacada
        'menu_icon' => 'dashicons-admin-generic', # Icono del menú en el admin
        'public' => true, # El post type es público
        'has_archive' => true, # Habilita el archivo para este post type (para que se puedan listar todos los casos de éxito en una página de archivo)
        'show_in_rest' => true, # Habilita la compatibilidad con el editor de bloques
        'supports' => array('title', 'editor', 'thumbnail'), # Sirve como un Alias para llamar directamente a las características del post-type (en este caso, título, editor y thumbnail)
    );

    register_post_type('casos_exito', $args); # 

}
add_action('init', 'create_casos_exito_cpt'); # Se lee de izquierda a derecha: se agrega una acción al hook 'init' (se ejecutala inicialización) para ejecutar la función 'create_casos_exito_cpt' que crea el Custom Post Type "Casos de Exito".

# Los que estan adentro son los pasos a seguir y lo que necesitamos y los que se encuentran afuera son los hooks, que son como los botones para ejecutar las funciones. 


/** Inicio del tipo de post de taxonomia de procedimientos */

function create_procedimientos_taxonomy() { #Función para crear la taxonomía "Procedimientos"
    $labels = array(  # Se crea la variable $labels con un array (Lista) de etiquetas para el Custom Post Type
        'name' => 'Procedimientos', # Nombre general de la taxonomía
        'singular_name' => 'Procedimiento', # Nombre singular de la taxonomía
        'search_items' => 'Buscar Procedimientos', # Texto para el formulario de búsqueda
        'all_items' => 'Todos los Procedimientos', # Texto para el enlace de todos los ítem
        'edit_item' => 'Editar Procedimiento', # Texto para el formulario de edición
        'update_item' => 'Actualizar Procedimiento', # Texto para el botón de actualización
        'add_new_item' => 'Agregar Nuevo Procedimiento', # Texto para el formulario de agregado nuevo
        'new_item_name' => 'Nuevo Nombre de Procedimiento', # Texto para el nuevo
        'menu_name' => 'Procedimientos' # Nombre del menú en el admin
    );
    $args = array( # Argumentos para la taxonomía
        'labels' => $labels, # Usa las etiquetas de nombres que definimos en $labels
        'hierarchical' => true, # Habilita la jerarquía (como categorías)
        'public' => true, # La taxonomía es pública, si está en false, nadie verá los Casos de Éxito en la web.
        'show_in_rest' => true, # Habilita la compatibilidad con el editor de bloques
        'show_ui' => true, # Muestra la interfaz de usuario en el admin
        'show_in_menu' => true, # Muestra la taxonomía en el menú del admin
    );
    register_taxonomy('procedimientos', array('casos_exito'), $args); # Registramos la taxonomía con el slug 'procedimientos', asociada al post-type 'casos_exito' y con los argumentos definidos de arriba 
    }
add_action('init', 'create_procedimientos_taxonomy'); # Hook para ejecutar la función de creación de la taxonomía en la inicialización de WordPress
# Con este hook, nos aseguramos de que la taxonomía se registre correctamente cada vez que WordPress se inicialice, lo que es esencial para que esté disponible en el panel de administración y en el sitio web.
<?php

$user = elgg_get_page_owner_entity();
if (!$user instanceof \ElggUser) {
	forward('', '404');
}

elgg_push_collection_breadcrumbs('object', 'event', $user, false);

$filter_value = '';

$title = elgg_echo('event_manager:attending:title', [$user->getDisplayName()]);
if ($user->guid === elgg_get_logged_in_user_guid()) {
	$filter_value = 'attending';
}

$content = elgg_list_entities([
	'type' => 'object',
	'subtype' => \Event::SUBTYPE,
	'relationship' => EVENT_MANAGER_RELATION_ATTENDING,
	'relationship_guid' => $user->guid,
	'inverse_relationship' => true,
	'no_results' => true,
]);

echo elgg_view_page($title, [
	'content' => $content,
	'filter_value' => $filter_value,
	'filter_id' => 'events',
]);

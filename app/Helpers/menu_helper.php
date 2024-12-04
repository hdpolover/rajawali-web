<?php
// app/Helpers/menu_helper.php

if (!function_exists('renderMenu')) {
    function renderMenu($items)
    {
        $html = '<ul class="menu">';
        foreach ($items as $item) {
            if (count($item->children) > 0) {
                $html .= '<li class="sidebar-item has-sub">
                            <a href="' . site_url($item->url) . '" class="sidebar-link">
                                <i class="' . $item->icon . '"></i>
                                <span>' . $item->title . '</span>
                            </a>
                            <ul class="submenu">';
                foreach ($item->children as $child) {
                    $html .= '<li class="submenu-item">
                                <a href="' . site_url($child->url) . '" class="submenu-link">' . $child->title . '</a>
                            </li>';
                }
                $html .= '</ul></li>';
            } else {
                $html .= '<li class="sidebar-item">
                            <a href="' . site_url($item->url) . '" class="sidebar-link">
                                <i class="' . $item->icon . '"></i>
                                <span>' . $item->title . '</span>
                            </a>
                        </li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 15.08.14
 * Time: 13:52
 */

namespace wapmorgan\NcursesObjects;


class Terminal {
    /**
     * @param $keycode
     * @return int
     */
    public function hasKey($keycode) {
        return ncurses_has_key($keycode);
    }

    /**
     * @return bool
     */
    public function hasColors() {
        return ncurses_has_colors();
    }

    /**
     * @return bool
     */
    public function hasIC() {
        return ncurses_has_ic();
    }

    /**
     * @return bool
     */
    public function hasIL() {
        return ncurses_has_il();
    }

    /**
     * @return bool
     */
    public function allAttributes() {
        return ncurses_termattrs();
    }

    /**
     * @return string
     */
    public function termName() {
        return ncurses_termname();
    }

    /**
     * @return string
     */
    public function longName() {
        return ncurses_longname();
    }


}

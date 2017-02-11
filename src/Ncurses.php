<?php
namespace wapmorgan\NcursesObjects;

/**
 * A ncurses object that implements functionality for main ncurses functions
 * @author wapmorgan (wapmorgan@gmail.com)
 */
class Ncurses {
	const KEY_LF = 10;
	const KEY_CR = 13;
	const KEY_ESC = 27;
	const KEY_TAB = 9;

	const CURSOR_INVISIBLE = 0;
	const CURSOR_NORMAL = 1;
	const CURSOR_VISIBLE = 2;

    /**
     * @var Terminal
     */
    private $terminal;

	/**
	 * Initializes ncurses
     *
     * @throws \RuntimeException
	 */
	public function __construct() {
        if (!function_exists('\ncurses_init')) {
            throw new \RuntimeException("Library <ncurses> is not loaded.");
        }
		ncurses_init();
	}

	/**
	 * Destructs ncurses
	 */
	public function __destruct() {
		ncurses_end();
	}

    /**
     * @return Terminal
     */
    public function getTerminal() {
        if (is_null($this->terminal))
            $this->terminal = new Terminal;
        return $this->terminal;
    }

	/**
	 * Sets echo state
	 * @param bool $state True of false
	 * @see http://www.php.net/manual/en/function.ncurses-echo.php
	 * @return $this
	 */
	public function setEchoState($state) {
		if ($state)
			ncurses_echo();
		else
			ncurses_noecho();
		return $this;
	}

	/**
	 * Sets new-line translation state
	 * @param bool $state True of false
	 * @return $this
	 */
	public function setNewLineTranslationState($state) {
		if ($state)
			ncurses_nl();
		else
			ncurses_nonl();
		return $this;
	}

	/**
	 * Sets cursor state
	 * @param integer $state CURSOR_INVISIBLE, CURSOR_NORMAL or CURSOR_VISIBLE
	 * @return $this
	 */
	public function setCursorState($state) {
		ncurses_curs_set($state);
		return $this;
	}

	/**
	 * Moves the main cursor
	 * @param integer $y Row
	 * @param integer $x Column
	 * @return $this
	 */
	public function moveOutput($y, $x) {
		ncurses_move($y, $x);
		return $this;
	}

	/**
	 * Refreshes the main window
	 * @return $this
	 */
	public function refresh() {
		ncurses_refresh(null);
		return $this;
	}

	/**
	 * Lets the terminal beep
	 * @return $this
	 */
	public function beep() {
		ncurses_beep();
		return $this;
	}

	/**
	 * Reads a char from keyboard
	 * @return int Ascii-code of char
	 * @see Keys for keys
	 */
	public function getCh() {
		return ncurses_getch();
	}

    /**
     * @param $ch
     * @return int
     */
    public function unGetCh($ch) {
        return ncurses_ungetch($ch);
    }

	/**
	 * Refreshes the virtual screen to reflect the relations between panels in the stack
	 * and
	 * Write all prepared refreshes to terminal
     *
     * @return $this
	 */
	public function updatePanels() {
		ncurses_update_panels();
		ncurses_doupdate();
		return $this;
	}

    /**
     * @param $char
     * @return $this
     */
    public function insertChar($char) {
        ncurses_insch($char);
        return $this;
    }

    /**
     * @param $count
     * @return $this
     */
    public function insertDeleteLines($count) {
        ncurses_insdelln($count);
        return $this;
    }

}

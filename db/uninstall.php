<?php
// This file is part of Moodle
//
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package block_multitext
 * @copyright 2023 Nasmak Technologies <info@nasmak.com.au>
 * @copyright based on work by 2023 Fateh Khan <team@nasmak.com.au>
 * @license http://www.gnu.org/copyleft/gpl.html
 */
defined('MOODLE_INTERNAL') || exit(0);

/**
 * This function is responsible for executing the
 * required routines when removing this plug-in.
 *
 * @return boolean
 */
function xmldb_block_multitext_uninstall() {

    
    return(true);

}
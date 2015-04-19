# Usage #

```
// Controller
function grid($grid = 'none')
{
  $columns = array(
    0 => array(
      'name' => 'Username',
      'db_name' => 'username',
      'header' => 'Username',
      'group' => 'User',
      'required' => TRUE,
      'unique' => TRUE,
      'form_control' => 'text_long',
      'type' => 'string'),
    1 => array(
      'name' => 'Age',
      'db_name' => 'age',
      'header' => 'Age',
      'group' => 'User',
      'required' => TRUE,
      'visible' => FALSE,
      'form_control' => 'text_short',
      'type' => 'integer')
  );

  $params = array(
    'id' => 'users',
    'table' => 'user',
    'url' => 'sample/grid',
    'uri_param' => $grid,
    'columns' => $columns
  );

  $this->load->library('carbogrid', $params);

  if ($this->carbogrid->is_ajax)
  {
    $this->carbogrid->render();
    return FALSE;
  }

  // Pass grid to the view (or you can call the render method directly in the view
  $data->page_grid = $this->carbogrid->render();

  $this->load->view('container', $data);
}
```


# Options #

| **Name** | **Default value** | **Description** |
|:---------|:------------------|:----------------|
| id | 'carbogrid' | Id of the wrapper div around the grid |
| url | '' | Base url of the controller which uses the grid |
| params\_before | '' | Controller parameters before the grid parameter |
| params\_after | '' | Controller parameters after the grid parameter |
| uri\_param | '' | Grid parameter |
| nested | FALSE | Is the grid nested in an existing form? If TRUE, no form tags are generated |
| ajax | TRUE | Enable ajax |
| ajax\_history | TRUE | Enable browser history on ajax requests |
|  |  |  |
| allow\_add | TRUE | Allow add new rows |
| allow\_edit | TRUE | Allow edit rows |
| allow\_delete | TRUE | Allow delete rows |
| allow\_filter | TRUE | Allow filtering in the grid. This can be refined at the column settings |
| allow\_columns | TRUE | Allow show/hide for the columns |
| allow\_select | TRUE | Allow row selection |
| allow\_pagination | TRUE | Allow pagination |
| allow\_sort | TRUE | Allow sort. This can be refined at the column settings |
| allow\_multisort | FALSE | Allow sort by multiple columns |
| **Pagination settings** |  |  |
| page\_size | 10 | No. of rows on a page |
| page | 1 | First displayed page |
| pagination\_links | 5 | No. of pagination links |
| limits | array(5 => 5, 10 => 10, 20 => 20, 50 => 50) | Available page sizes |
| **Appearance settings** |  |  |
| show\_empty\_rows | TRUE | If last page does not contain the no. of rows specified by page\_size, fill up grid with empty rows |
| max\_cell\_length | 50 | Max no. of characters displayed in a grid cell |
| **Filter and sort settings** |  |  |
| filters | array() | Initial grid filters |
| hard\_filters | array() | Filters that are always applied |
| order | array() | Initial sort on grid |
| **Column settings** |  |  |
| columns | array() | Columns to show |
| columns\_visible | array() | Initially visible columns (list of column keys) |
| **Command settings** |  |  |
| commands | array() | Override default (add/edit/delete) commands and define new ones |
| **Database settings** |  |  |
| table | NULL | Database table to select from |
| table\_id\_name | 'id' | Name of the id column in the table (multiple keys are currently not supported) |
| get\_data | '' | Custom function to fill up the grid with data |

## Columns ##

| **Name** | **Default value** | **Description** |
|:---------|:------------------|:----------------|
| name | '' | Column name and field label on the form |
| type | 'string' | Column type. Supported types are: 'string', 'text', 'integer', 'boolean', 'date', 'time', 'datetime', 'file' (experimental), '1-n' |
| header | '' | Column header text |
| visible | TRUE | Show/hide column. If FALSE, column cannot be set to visible on the page neither. |
| display | '' | Custom formatting of the value, accepts the name of the formatting function, and gets called with $row\_id, $column\_key, $value parameters |
| allow\_filter | TRUE | Allow filtering on this column. Global filter option must be enabled. |
| allow\_sort | TRUE | Allow sort on this column. Global sort option must be enabled |
| **Date and time settings** |  |  |
| date\_format | 'm/d/Y' | Date format settings, accepts php date formatting strings. Applied if type is 'date' or 'datetime' |
| time\_format | 'h:i A' | Timeformat settings, accepts php time formatting strings. Applied if type is 'time' or 'datetime' |
| **File upload settings** |  |  |
| upload\_path | './files' | Upload path for the type 'file' |
| upload\_path\_temp | './files/temp' | Temporary upload path for the type 'file' (files are stored here, until the item is saved. |
| allowed\_types | 'gif|jpg|png' | File types allowed to upload. |
| max\_size | '1024' | Max file size allowed to upload. |
| **Foreign key settings** |  |  |
| ref\_table\_db\_name | '' | Name of the table to join for type '1-n' |
| ref\_field\_db\_name | '' | Name of the field to be displayed from the referenced table |
| ref\_field\_type | '' | Type of the displayed field |
| ref\_table\_id\_name | 'id' | ID column name of the referenced table |
| **Form settings** |  |  |
| form\_visible | TRUE | Show/hide field on add/edit form |
| form\_control | 'text\_long' | The generated form control for the field. Possible values: 'text\_long', 'text\_short', 'checkbox', 'dropdown', 'textarea', 'datepicker', 'timepicker', 'datetimepicker', 'file' |
| form\_default | '' | Default value for the field on the add new form |
| group | '' | Form can be organized in collapsable sections. Set the same value for the fields you want to appear in a section. The value will appear as the title of the section. |
| **Form validation settings**|  |  |
| required | FALSE | Field is required if TRUE |
| unique | FALSE | Field value must be unique in the database table if TRUE |
| min\_length | NULL | Minimum length of the field value |
| max\_length | NULL | Maximum length of the field value |
| validation | '' | Any other validation settings specified as for CI Form Validation (e.g. 'greater\_than[10](10.md)|less\_than[20](20.md)') |

## Commands ##

| **Name** | **Default value** | **Description** |
|:---------|:------------------|:----------------|
| name | '' | Command unique name |
| text | '' | Command name displayed for the user |
| icon | '' | Icon for the command. jQuery UI icons can be used (without 'ui-' prefix: 'pencil', 'trash' ...) |
| type | 'dialog' | Command type. Possible values: 'dialog' - Function must return the HTML to show in the dialog or TRUE if command executed, 'url' - Command redirects to the specified url passing row id(s) as last parameter, 'post' - The function is called with row id(s) and command filters as parameters, no return values is needed |
| function | '' | Function to call (must be a function in the controller) |
| url | '' | Command url (if type is url and you want to redirect to another page |
| multi | FALSE | Command can be called on multiple selected rows if TRUE. |
| toolbar | FALSE | Show command button on the toolbar |
| grid | TRUE | Show command column on the grid |
| ajax | TRUE | Enable / disable ajax for the command |
| confirm | FALSE | Show confirmation dialog before executing command |
| confirm\_title | '' | Confirm dialog title |
| confirm\_text | '' | Confirm dialog text |
| confirm\_yes | '' | Confirm Yes button text |
| confirm\_no | '' | Confirm No button text |
| dialog\_save | '' | Dialog Save button text |
| dialog\_cancel | '' | Dialog Cancel button text |
| filters | array() | Command can be called on rows matching the filters |

## Filters ##

Filters can be passed in the following format:
```
  array(
    'column_key_1' => array('value' => 'xyz'),
    'column_key_2' => array('value' => 4, 'operator' => 'lt')
    // ...
  )
```

Supported operators:
  * eq - Equals (=)
  * noteq - Not equals (!=)
  * lt - Less than (<)
  * lte - Less than or equal (<=)
  * gt - Greater than (>)
  * gte - Greater than or equal (>=)
  * in - WHERE IN
  * notin - WHERE NOT IN
  * like - LIKE '%value%'
  * notlike - NOTLIKE '%value%'
  * starts - LIKE 'value%'
  * ends - LIKE '%value'

If operator is not specified, it defaults to 'eq'.
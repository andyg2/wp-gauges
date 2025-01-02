<?php
if (!defined('WPINC')) {
  die;
}

function wp_gauges_admin_page()
{
?>
  <div class="wrap">
    <h1>WP Gauges Shortcode Generator</h1>
    <div class="gauge-container">
      <div class="gauge-form card">
        <form id="gauge-shortcode-generator">
          <table class="form-table">
            <tr>
              <th scope="row"><label for="gauge-title">Title</label></th>
              <td>
                <input type="text" id="gauge-title" class="regular-text" value="Title" placeholder="Title">
                <p class="description">The title of your gauge</p>
              </td>
            </tr>
            <tr>
              <th scope="row"><label for="gauge-units">Units</label></th>
              <td>
                <input type="text" id="gauge-units" class="regular-text" value="units" placeholder="units">
                <p class="description">The units to display (e.g., mph, °C, %)</p>
              </td>
            </tr>
            <tr>
              <th scope="row"><label for="gauge-titletag">Title Tag</label></th>
              <td>
                <select id="gauge-titletag">
                  <option value="h1">H1</option>
                  <option value="h2" selected>H2</option>
                  <option value="h3">H3</option>
                  <option value="h4">H4</option>
                  <option value="h5">H5</option>
                  <option value="h6">H6</option>
                </select>
                <p class="description">HTML tag for the title</p>
              </td>
            </tr>
            <tr>
              <th scope="row"><label for="gauge-titlecol">Title Color</label></th>
              <td>
                <input type="color" id="gauge-titlecol" value="#000000" placeholder="#000000">
                <p class="description">Color of the title text</p>
              </td>
            </tr>
            <tr>
              <th scope="row"><label for="gauge-min">Minimum Value</label></th>
              <td>
                <input type="number" id="gauge-min" value="0" placeholder="0">
                <p class="description">Minimum value on the gauge</p>
              </td>
            </tr>
            <tr>
              <th scope="row"><label for="gauge-max">Maximum Value</label></th>
              <td>
                <input type="number" id="gauge-max" value="10" placeholder="10">
                <p class="description">Maximum value on the gauge</p>
              </td>
            </tr>
            <tr>
              <th scope="row"><label for="gauge-ticks">Ticks</label></th>
              <td>
                <input type="text" id="gauge-ticks" class="regular-text" value="0 2 4 6 8 10" placeholder="0 2 4 6 8 10">
                <p class="description">Space-separated list of tick values</p>
              </td>
            </tr>
            <tr>
              <th scope="row"><label for="gauge-initial">Initial Value</label></th>
              <td>
                <input type="number" id="gauge-initial" value="0" placeholder="0">
                <p class="description">Starting value of the gauge</p>
              </td>
            </tr>
            <tr>
              <th scope="row"><label for="gauge-animateto">Animate To</label></th>
              <td>
                <input type="number" id="gauge-animateto" value="5" placeholder="5">
                <p class="description">Value to animate to (leave empty for no animation)</p>
              </td>
            </tr>
            <tr>
              <th scope="row"><label>Color Ranges</label></th>
              <td>
                <div class="color-ranges">
                  <div>
                  <label><nobr></label>
                  <div style="width: 94px; display:inline-block; text-align: center; margin-bottom: 0px;">Start</div>
                  <div style="width: 80px; display:inline-block; text-align: center; margin-bottom: 0px;">End</div>
                  </div>
                  <div>
                    <label>Green Range:</label>
                    <input type="number" id="gauge-green-start" placeholder="0" style="width: 80px"> -
                    <input type="number" id="gauge-green-end" placeholder="3" style="width: 80px">
                  </div>
                  <div>
                    <label>Yellow Range:</label>
                    <input type="number" id="gauge-yellow-start" placeholder="3" style="width: 80px"> -
                    <input type="number" id="gauge-yellow-end" placeholder="5" style="width: 80px">
                  </div>
                  <div>
                    <label>Orange Range:</label>
                    <input type="number" id="gauge-orange-start" placeholder="5" style="width: 80px"> -
                    <input type="number" id="gauge-orange-end" placeholder="7" style="width: 80px">
                  </div>
                  <div>
                    <label>Red Range:</label>
                    <input type="number" id="gauge-red-start" placeholder="7" style="width: 80px"> -
                    <input type="number" id="gauge-red-end" placeholder="10" style="width: 80px">
                  </div>
                </div>
              </td>
            </tr>
          </table>
          <p class="submit">
            <button type="button" class="button button-primary" id="generate-shortcode">Generate Shortcode</button>
          </p>
        </form>
      </div>
      <div class="gauge-preview card">
        <h2>Live Preview</h2>
        <div id="gauge-preview-container">
          <canvas id="preview-gauge"></canvas>
        </div>
      </div>
    </div>
    <div class="card" style="display: none;" id="shortcode-output">
      <h2>Generated Shortcode</h2>
      <div class="shortcode-container">
        <pre id="shortcode-text"></pre>
        <button type="button" class="button" id="copy-shortcode">Copy to Clipboard</button>
      </div>
    </div>
  </div>
<?php
}

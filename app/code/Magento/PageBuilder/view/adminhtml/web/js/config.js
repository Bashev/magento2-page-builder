/*eslint-disable */
/* jscs:disable */
define(["underscore"], function (_underscore) {
  /**
   * Copyright © Magento, Inc. All rights reserved.
   * See COPYING.txt for license details.
   */
  var Config = /*#__PURE__*/function () {
    "use strict";

    function Config() {}

    /**
     * Set the initial config
     *
     * @param config
     */
    Config.setConfig = function setConfig(config) {
      Config.config = _underscore.extend(Config.config, config);
    }
    /**
     * Set the current instances mode, this differs between preview or master depending on whether we're rendering the
     * admins preview or rendering the master format.
     *
     * @param {"Preview" | "Master"} mode
     */
    ;

    Config.setMode = function setMode(mode) {
      Config.mode = mode;
    }
    /**
     * Retrieve the current instances mode
     */
    ;

    Config.getMode = function getMode() {
      return Config.mode;
    }
    /**
     * Set the content snapshot mode to show the page builder stage
     * when page builder is enabled
     *
     * @param contentSnapshot
     */
    ;

    Config.setContentSnapshot = function setContentSnapshot(contentSnapshot) {
      Config.contentSnapshot = contentSnapshot;
    }
    /**
     * Set the content snapshot flag to inform other components about fullscreen mode
     * when page builder is enabled
     *
     * @param flag
     */
    ;

    Config.setContentSnapshotFullScreenMode = function setContentSnapshotFullScreenMode(flag) {
      Config.contentSnapshot.isFullScreen = flag;
    }
    /**
     * Set the content snapshot page builder id
     *
     * @param id
     */
    ;

    Config.setContentSnapshotPageBuilderId = function setContentSnapshotPageBuilderId(id) {
      Config.contentSnapshot.pageBuilderId = id;
    }
    /**
     * Retrieve the current instances mode
     */
    ;

    Config.getContentSnapshot = function getContentSnapshot() {
      return Config.contentSnapshot;
    }
    /**
     * Retrieve the init config
     *
     * @param {string} key
     * @returns {T}
     */
    ;

    Config.getConfig = function getConfig(key) {
      if (key) {
        if (typeof Config.config[key] !== "undefined") {
          return Config.config[key];
        }

        return null;
      }

      return Config.config;
    }
    /**
     * Retrieve a content type from the configuration
     *
     * @param {string} contentType
     * @returns {any}
     */
    ;

    Config.getContentTypeConfig = function getContentTypeConfig(contentType) {
      if (typeof Config.getConfig("content_types")[contentType] !== "undefined") {
        return Config.getConfig("content_types")[contentType];
      }

      return null;
    };

    return Config;
  }();

  Config.config = {
    dataContentTypeAttributeName: "data-content-type"
  };
  return Config;
});
//# sourceMappingURL=config.js.map